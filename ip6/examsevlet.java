import java.io.IOException ;
import java.io.PrintWriter ;
import javax.servlet.ServletException ;
import javax.servlet.annotation.WebServlet ;
import javax.servlet.http.HttpServlet ;
import javax.servlet.http.HttpServletRequest ;
import javax.servlet.http.HttpServletResponse ;
@WebServlet ("/ExamServlet ")
public class ExamServlet extends HttpServlet {
 private static final long serialVersionUID = 1L;
 protected void doPost(HttpServletRequest request, HttpServletResponse response)
 throws ServletException , IOException {
 response.setContentType ("text/html");
 PrintWriter out = response.getWriter ();
 int totalQuestions = 10;
 int score = 0;
 // Loop moolam q1 mudhal q10 varai ulla values- ai edukkirom
 for (int i = 1; i <= totalQuestions ; i++) {
 // Note: HTML- il kelvi 9-rkku name="q8" enru thavaraga ullathu.
 // Ungal HTML- il athai name="q9" enru matriyal intha loop sariyaga velai seiyum .
 String paramName = "q" + i;
 String answerValue = request.getParameter (paramName );
 // User option select seithirundhal mattum score add aagum
 if (answerValue != null) {
 score += Integer.parseInt (answerValue );
}
}
// Result page output
 out.println ("<html><head><title>Exam Result</title>");
 out.println ("<style>body{ font-family:Arial ; text-align:center ; margintop:50px;} .result-box{border:1px solid #ccc; padding:20px; display:inline-block ; borderradius:10px; background:#f9f9f9;}</style>");
 out.println ("</head><body>");
 out.println ("<div class='result- box'>");
 out.println ("<h2>Examination Results</h2>");
 out.println ("<p>Your Score: <b>" + score + "</b> / " + totalQuestions + "</p>");
 double percentage = ((double) score / totalQuestions ) * 100;
 out.println ("<p>Percentage: <b>" + percentage + "% </b></p>");
 if (percentage >= 50) {
 out.println ("<h3 style=' color:green ;'>Status: Passed</h3>");
} else {
 out.println ("<h3 style=' color:red ;'>Status: Failed</h3>");
}
 out.println ("< br><a href ='index.html'>Take Exam Again</a>");
 out.println ("</div></body></html>");
}
}