<!-- Footer opened -->
	<div class="main-footer ht-40">
		<div class="container-fluid pd-t-0-f ht-100p">
			<footer id="footer">
                &copy; <span id="year"></span> ZiadWeb. All rights reserved.
              </footer>
		</div>
	</div>

    <script>
        // الحصول على السنة الحالية
const currentYear = new Date().getFullYear();

// تحديث النص داخل العنصر الذي يحمل معرف "year"
document.getElementById("year").textContent = currentYear;

    </script>
<!-- Footer closed -->
