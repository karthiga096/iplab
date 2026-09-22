import java.io.IOException; 
import java.io.PrintWriter; 
import java.util.concurrent.atomic.AtomicInteger; 
 
import javax.servlet.ServletException; 
import javax.servlet.annotation.WebServlet; 
import javax.servlet.annotation.WebListener; 
import javax.servlet.http.HttpServlet; 
import javax.servlet.http.HttpServletRequest; 
import javax.servlet.http.HttpServletResponse; 
import javax.servlet.http.HttpSession; 
import javax.servlet.http.HttpSessionEvent; 
import javax.servlet.http.HttpSessionListener; 
 
@WebServlet("/WelcomeServlet") 
@WebListener 
public class WelcomeServlet extends HttpServlet 
        implements HttpSessionListener { 
 
    private static final AtomicInteger uniqueVisitors = 
            new AtomicInteger(0); 
 
    @Override 
    public void sessionCreated(HttpSessionEvent se) { 
        uniqueVisitors.incrementAndGet(); 
    } 
 
    @Override 
    public void sessionDestroyed(HttpSessionEvent se) { 
    } 
 
    public static int getUniqueVisitors() { 
        return uniqueVisitors.get(); 
    } 
 
    @Override 
    protected void doPost(HttpServletRequest request, 
            HttpServletResponse response) 
            throws ServletException, IOException { 
 
        response.setContentType("text/html"); 
 
        PrintWriter out = response.getWriter(); 
 
        String name = request.getParameter("uname"); 
        String password = request.getParameter("pwd"); 
 
        HttpSession session = request.getSession(); 
 
        session.setAttribute("user", name); 
 
        out.println("<html>"); 
        out.println("<head>"); 
        out.println("<title>Welcome</title>"); 
 
        out.println("<style>"); 
 
        out.println("body{"); 
        out.println("font-family:Arial,sans-serif;"); 
        out.println("background:linear-gradient(135deg,#74ebd5,#ACB6E5);"); 
        out.println("margin:0;"); 
        out.println("padding:50px;"); 
        out.println("}"); 
 
        out.println(".box{"); 
        out.println("background:white;"); 
        out.println("padding:30px;"); 
        out.println("border-radius:15px;"); 
        out.println("max-width:500px;"); 
        out.println("margin:auto;"); 
        out.println("box-shadow:0 10px 25px rgba(0,0,0,0.2);"); 
        out.println("}"); 
 
        out.println("h2{text-align:center;color:#2c3e50;}"); 
 
        out.println(".card{"); 
        out.println("background:#f4f7fa;"); 
        out.println("padding:15px;"); 
        out.println("margin-top:15px;"); 
        out.println("border-radius:8px;"); 
        out.println("}"); 
 
        out.println("a{"); 
        out.println("display:block;"); 
        out.println("padding:12px;"); 
        out.println("margin-top:10px;"); 
        out.println("background:#3498db;"); 
        out.println("color:white;"); 
        out.println("text-decoration:none;"); 
        out.println("text-align:center;"); 
        out.println("border-radius:8px;"); 
        out.println("}"); 
 
        out.println("</style>"); 
        out.println("</head>"); 
 
        out.println("<body>"); 
 
        out.println("<div class='box'>"); 
 
        out.println("<h2>Welcome, " + name + "!</h2>"); 
 
        out.println("<div class='card'>"); 
        out.println("<b>Session ID:</b><br>"); 
        out.println(session.getId()); 
        out.println("</div>"); 
 
        out.println("<div class='card'>"); 
        out.println("<b>Total Unique Visitors:</b><br>"); 
        out.println(getUniqueVisitors()); 
        out.println("</div>"); 
 
        // Hidden Form Field 
        out.println("<h3>1. Hidden Form Field</h3>"); 
 
        out.println("<form action='WelcomeServlet' method='post'>"); 
 
        out.println("<input type='hidden' name='hiddenName' value='" 
                + name + "'>"); 
 
        out.println("<input type='hidden' name='hiddenPassword' value='" 
                + password + "'>"); 
 
        out.println("<input type='hidden' name='action' value='hidden'>"); 
 
        out.println("<input type='submit' value='Go to Hidden Field'>"); 
 
        out.println("</form>"); 
 
        // URL Rewriting 
        out.println("<h3>2. URL Rewriting</h3>"); 
 
        String url = response.encodeURL( 
                "WelcomeServlet?action=url&uname=" 
                + name + "&pwd=" + password); 
 
        out.println("<a href='" + url + "'>"); 
        out.println("Visit URL Rewriting"); 
        out.println("</a>"); 
 
        out.println("</div>"); 
 
        out.println("</body>"); 
        out.println("</html>"); 
    } 
 
    @Override 
    protected void doGet(HttpServletRequest request, 
            HttpServletResponse response) 
            throws ServletException, IOException { 
 
        response.setContentType("text/html"); 
 
        PrintWriter out = response.getWriter(); 
 
        String action = request.getParameter("action"); 
 
        // URL Rewriting 
        if ("url".equals(action)) { 
 
            String name = request.getParameter("uname"); 
            String password = request.getParameter("pwd"); 
 
            out.println("<html>"); 
            out.println("<head>"); 
            out.println("<title>URL Rewriting</title>"); 
            out.println("</head>"); 
 
            out.println("<body style='font-family:Arial;" 
                    + "background:#f4f6f8;text-align:center;" 
                    + "padding:60px;'>"); 
 
            out.println("<div style='background:white;" 
                    + "padding:30px;border-radius:15px;" 
                    + "max-width:450px;margin:auto;" 
                    + "box-shadow:0 10px 25px rgba(0,0,0,0.2);'>"); 
 
            out.println("<h2>Hello, " + name + "!</h2>"); 
 
            out.println("<p><b>Password Received:</b> " 
                    + password + "</p>"); 
 
            out.println("<p>"); 
            out.println("This data was passed using URL Rewriting."); 
            out.println("</p>"); 
 
            out.println("<a href='index.html'>"); 
            out.println("Back to Home"); 
            out.println("</a>"); 
 
            out.println("</div>"); 
 
            out.println("</body>"); 
            out.println("</html>"); 
        } 
 
        // Hidden field result 
        else if ("hidden".equals(action)) { 
 
            String name = request.getParameter("hiddenName"); 
            String password = 
                    request.getParameter("hiddenPassword"); 
 
            out.println("<html>"); 
            out.println("<head><title>Hidden Field</title></head>"); 
 
            out.println("<body style='font-family:Arial;" 
                    + "background:#f4f6f8;text-align:center;" 
                    + "padding:60px;'>"); 
 
            out.println("<div style='background:white;" 
                    + "padding:30px;border-radius:15px;" 
                    + "max-width:450px;margin:auto;" 
                    + "box-shadow:0 10px 25px rgba(0,0,0,0.2);'>"); 
 
            out.println("<h2>Hello, " + name + "!</h2>"); 
 
            out.println("<p><b>Password Received:</b> " 
                    + password + "</p>"); 
 
            out.println("<p>"); 
            out.println("This data was passed using Hidden Form Fields."); 
            out.println("</p>"); 
 
            out.println("<a href='index.html'>"); 
            out.println("Back to Home"); 
            out.println("</a>"); 
 
            out.println("</div>"); 
 
            out.println("</body>"); 
            out.println("</html>"); 
        } 
    } 
}