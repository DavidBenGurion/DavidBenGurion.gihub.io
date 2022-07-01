  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <?php if (isset($_GET['login'])) : ?>
                      <div class="alert alert-danger" id="failLogin" role="alert">
                          Login Gagal
                      </div>
                  <?php endif ?>
                  <form action="Login.php" method="post">
                      <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Username</label>
                          <input type="text" name="username" class="form-control" id="exampleInputEmail1">
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                      </div>
                      <a href="register.php">Belum punya Akun silahkan Registrasi</a>
                      <br>
                      <button style="margin-top:15px" name="submit" type="submit" class="btn btn-primary">Login</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <script>
      function closeLogin() {
          $('#failLogin').css('display', 'none');
      }
      if ($('#failLogin').css('display') == "block") {
          $('#LoginBtn').trigger('click');
          setTimeout(closeLogin, 5000);
      }
      $(document).ready(function() {
          console.log(username);
          if (username == "") {
              $('#nav-keranjang').css('display', 'none');
          } else {
              getCart();
          }

      });

      function addToCart(id) {
          $.ajax({
              url: 'cart.php',
              data: 'id=' + id,
              type: 'GET',
              success: function(result) {
                  if (result === '1') {
                      alert('Produk berhasil ditambahkan.');
                      getCart();
                  }
              }
          });
      }
      var username = $('#txt-username').text();

      function getCart() {
          $.ajax({
              url: 'cart.php',
              type: 'GET',
              success: function(result) {
                  $('#item-cart').html(result);
              }
          });
      }

      function hapusCart(id) {
          if (confirm('Yakin hapus produk ini ?')) {
              $.ajax({
                  url: 'cart.php',
                  type: 'GET',
                  data: 'id=' + id + '&tipe=hapus',
                  success: function(result) {
                      if (result === '1') {
                          alert('Produk berhasil dihapus.');
                          location.reload();
                      }
                  }
              });
          }
      }

      function updateCart(id, tipe) {
          $.ajax({
              url: 'cart.php',
              type: 'GET',
              data: 'id=' + id + '&tipe=' + tipe,
              success: function(result) {
                  if (result === '1') {
                      location.reload();
                  }
              }
          });
      }
  </script>
  </body>

  </html>