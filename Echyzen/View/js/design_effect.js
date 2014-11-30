$(document).ready(function(){

	
	//	Animation du footer
	setInterval(function() {
		rond1(); rond2(); rond3(); rond4(); rond5(); rond6();
	}, 1000);
	
	function rond1 () { $('#rond1').animate({bottom:"60px", left:"20px"}, 2000).animate({bottom:"-60px", left:"30px"}, 2000); } // rond1()
	
	function rond2 () { $('#rond2').animate({bottom:"60px", right:"190px"}, 3000).animate({bottom:"-60px", right:"200px"}, 3000); } // rond2()
	
	function rond3() { $('#rond3').animate({bottom:"60px", right:"300px"}, 5000).animate({bottom:"-60px", right:"300px"}, 5000); } // rond3()
	
	function rond4() { $('#rond4').animate({bottom:"75px", left:"400px"}, 1500).animate({bottom:"-75px", left:"430px"}, 1500).animate({left:"300px"}, 0); } // rond4()
	
	function rond5() { $('#rond5').animate({bottom:"80px", left:"100px"}, 6000).animate({bottom:"-80px", left:"100px"}, 6000); } // rond5()	
	
	function rond6() { $('#rond6').animate({bottom:"80px", left:"280px"}, 5500).animate({bottom:"-80px", left:"300px"}, 5000).animate({right:"180x"}, 0); } // rond6()

	}); // $(document).ready()