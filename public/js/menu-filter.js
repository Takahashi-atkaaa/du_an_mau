// Menu Filter Functionality
$(document).ready(function () {
  // Initialize Isotope
  var $grid = $(".grid").isotope({
    itemSelector: ".col-sm-6",
    layoutMode: "fitRows",
  });

  // Filter items on button click
  $(".filters_menu").on("click", "li", function () {
    var filterValue = $(this).attr("data-filter");

    // Remove active class from all buttons
    $(".filters_menu li").removeClass("active");
    // Add active class to clicked button
    $(this).addClass("active");

    // Filter items
    if (filterValue === "*") {
      $grid.isotope({ filter: "*" });
    } else {
      $grid.isotope({ filter: filterValue });
    }
  });

  // Add smooth animation
  $grid.isotope({
    transitionDuration: "0.4s",
  });

  // Add hover effects
  $(".box").hover(
    function () {
      $(this).addClass("hover-effect");
    },
    function () {
      $(this).removeClass("hover-effect");
    }
  );

  // Add to cart functionality
  $(".add-to-cart").click(function (e) {
    e.preventDefault();
    var productName = $(this).closest(".box").find("h5").text();
    var productPrice = $(this).closest(".box").find("h6").text();

    // Show notification
    showNotification(productName + " đã được thêm vào giỏ hàng!", "success");

    // Add animation
    $(this).addClass("added-to-cart");
    setTimeout(function () {
      $(".add-to-cart").removeClass("added-to-cart");
    }, 1000);
  });
});

// Notification function
function showNotification(message, type) {
  var notification = $(
    '<div class="notification ' + type + '">' + message + "</div>"
  );
  $("body").append(notification);

  // Show notification
  setTimeout(function () {
    notification.addClass("show");
  }, 100);

  // Hide notification after 3 seconds
  setTimeout(function () {
    notification.removeClass("show");
    setTimeout(function () {
      notification.remove();
    }, 300);
  }, 3000);
}

// Add CSS for notifications and animations
var style = `
<style>
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    z-index: 9999;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    max-width: 300px;
}

.notification.show {
    transform: translateX(0);
}

.notification.success {
    background-color: #28a745;
}

.notification.error {
    background-color: #dc3545;
}

.hover-effect {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.added-to-cart {
    animation: cartBounce 0.5s ease;
}

@keyframes cartBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

.filters_menu li {
    cursor: pointer;
    transition: all 0.3s ease;
}

.filters_menu li:hover {
    background-color: #ffbe33;
    color: #222831;
}

.filters_menu li.active {
    background-color: #ffbe33;
    color: #222831;
}

.box {
    transition: all 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
}

.box:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.img-box img {
    transition: transform 0.3s ease;
}

.box:hover .img-box img {
    transform: scale(1.05);
}

.options a {
    transition: all 0.3s ease;
}

.options a:hover {
    transform: scale(1.1);
}
</style>
`;

// Add style to head
$("head").append(style);
