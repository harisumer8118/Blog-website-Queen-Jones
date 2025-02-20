<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="carousel/jquery.min.js"></script>
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- <script>
$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:0,
            nav:true
        },
        600:{
            items:5 ,
            nav:false
        }, 
       
        1000:{
            items:7,
            nav:true,
            loop:false
        },
       
    }
})
})



      </script> -->

      <script>
$(document).ready(function(){
  var owl = $('.owl-carousel');
  var intervalId;

  owl.owlCarousel({
    loop: true,
    margin: 25,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 3,
            nav: false
        },
        1000: {
            items: 7,
            nav: false,
            loop: false
        }
    }
  });



  // Function to start moving the carousel
  function startCarousel(direction) {
    intervalId = setInterval(function() {
      if (direction === 'prev') {
        owl.trigger('prev.owl.carousel');
      } else if (direction === 'next') {
        owl.trigger('next.owl.carousel');
      }
    }, 550);
  }

  // Hover events to start/stop the carousel
  $('#prevButton').hover(function() {
    startCarousel('prev');
  }, function() {
    clearInterval(intervalId);
  });

  $('#nextButton').hover(function() {
    startCarousel('next');
  }, function() {
    clearInterval(intervalId);
  });
});


/////////////////////



</script>


<!-- //////////////////////////////   side bar nav  -->

<script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var links = sidebar.querySelectorAll('a');
            var main = document.getElementById("main");
            var openBtn = document.getElementById("openbtn");

            if (sidebar.style.width === "250px") {
                sidebar.style.width = "0";
                main.style.marginLeft = "0";
                openBtn.classList.remove('hidden');
                links.forEach(function(link) {
                    link.classList.remove('show');
                });
            } else {
                sidebar.style.width = "250px";
                main.style.marginLeft = "250px";
                openBtn.classList.add('hidden');
                links.forEach(function(link, index) {
                    setTimeout(function() {
                        link.classList.add('show');
                    }, 100 * index);
                });
            }
        }
    </script>
