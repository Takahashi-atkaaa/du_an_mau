<?php require_once(__DIR__ . '/header.php'); ?>

<!-- Custom Menu CSS -->
<link rel="stylesheet" href="public/css/menu-custom.css">

<!-- Food Section -->
<section class="food_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Menu
        <!-- Danh mục -->
        <ul class="filters_menu">
          <li class="active"  data-filter="*">Tất cả</li>
          <?php foreach ($category as $c): ?>
            <?php $slug = isset($c['slug']) ? $c['slug'] : strtolower(str_replace(' ', '-', $c['name'])); ?>
            <li data-filter=".<?= $slug ?>"><?= $c['name'] ?></li>
          <?php endforeach; ?>
        </ul>

      </h2>

    </div>

    <!-- Danh mục -->
    <ul class="filters_menu">
      <li class="active" data-filter="*">Tất cả</li>
      <?php foreach ($category as $c): ?>
        <?php $slug = isset($c['slug']) ? $c['slug'] : strtolower(str_replace(' ', '-', $c['name'])); ?>
        <li data-filter=".<?= $slug ?>"><?= $c['name'] ?></li>
      <?php endforeach; ?>
    </ul>


    <!-- Món ăn -->
    <div class="filters-content">
      <div class="row grid">
        <?php if (!empty($products) && is_array($products)): ?>
          <?php foreach ($products as $p): ?>
            <?php
            $cat_slug = isset($p['category_slug']) ? $p['category_slug'] : '';
            $image    = isset($p['image']) ? $p['image'] : 'default.png';
            $name     = isset($p['name']) ? $p['name'] : 'Tên món';
            $desc     = isset($p['description']) ? $p['description'] : '';
            $price    = isset($p['price']) ? $p['price'] : 0;
            $oldPrice = isset($p['old_price']) ? $p['old_price'] : 0;
            ?>
            <div class="col-sm-6 col-lg-4 all <?= $cat_slug ?>">
              <div class="box">
                <div class="img-box">
                  <img src="public/images/<?= $image ?>" alt="<?= $name ?>" class="img-fluid">
                </div>
                <div class="detail-box">
                  <h5><?= $name ?></h5>
                  <p><?= $desc ?></p>
                  <div class="options">
                    <?php if ($oldPrice > $price): ?>
                      <h6 style="text-decoration: line-through;"><?= $oldPrice ?>$</h6>
                    <?php endif; ?>
                    <h6><?= $price ?>$</h6>
                    <a href="#" class="add-to-cart">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;"
                        xml:space="preserve">
                        <g>
                          <g>
                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Hiện chưa có sản phẩm nào.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- end food section -->

<?php require_once './views/feane/footer.php'; ?>

<!-- Isotope JS for filtering -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var grid = document.querySelector('.grid');
    if (grid) {
      var iso = new Isotope(grid, {
        itemSelector: '.all',
        layoutMode: 'fitRows'
      });

      var filterButtons = document.querySelectorAll('.filter-btn');
      filterButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
          var filterValue = btn.getAttribute('data-filter');
          iso.arrange({
            filter: filterValue
          });
        });
      });
    }
  });
</script>