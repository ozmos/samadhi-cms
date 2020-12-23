<footer class="flex wrap">
   
    <section>
    <span class="copyright-info">
            &copy; 
            <span id="copyright">
                <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
            </span>
        <a href="https://github.com/ozmos" target="blank">
					Osamu Morozumi</a>
        </span>
    </section>
    <section>
            <a href="https://pcwebsites.com.au" target="blank">Perth Custom Websites</a>
    </section>
  </footer>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.min.js"></script>
  <!-- scripts with no dependancies -->
   <?php

    foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/content/js/globals/*.js") as $filename) {
      $start = strpos($filename, '/content/');
      $filename = substr($filename, $start);
      echo '<script src="'. $filename . '"></script>';
    }
    if (isset($page['scripts'])) {
      foreach ($page['scripts'] as $script) {
          echo '<script src="/content/js/'. $script . '.js"></script>';
      }
    }
  ?>
</body>
</html>
