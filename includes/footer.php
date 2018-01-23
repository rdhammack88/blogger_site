</div> <!-- End of .body-container -->

<!-- Footer -->
<footer class="text-center col-sm-12 navbar-fixed-bottom">
	<small>Created with <span class="love">&hearts;</span> by <a href="http://www.dustinhammack.com/" target="_blank" title="Portfolio site for Dustin Hammack" data-toggle="tooltip" data-placement="bottom">Dustin Hammack</a>!</small>  
</footer>

<!-- jQuery Scripts -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<!-- Bootstrap Minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- Custom Scripts -->
<script src="js/scripts.js"></script>

<?php
/* Close connection to DB */
if(isset($conn)) {
	mysqli_close($conn);
}
?>

</body>
</html>