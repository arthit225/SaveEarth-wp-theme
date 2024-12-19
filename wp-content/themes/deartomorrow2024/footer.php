    </main>

    <footer>
      <?php get_template_part ('inc/sectionblocks/subscribe'); ?>
      <?php get_template_part ('inc/sectionblocks/copyright'); ?>
      <div class="flex-0 bg-slate-100 px-4 py-2">
          <div class="container mx-auto text-center">
              <p class="text-xs text-midnight-blue">Currently in <strong><?php echo (IS_VITE_DEVELOPMENT) ? "development" : "production" ?></strong> mode.</p>
          </div>
      </div>
    </footer>
    

<?php wp_footer() ?>

<script>
  window.Userback = window.Userback || {};
  Userback.access_token = 'P-ifJO85Rc68vrREaTH8syVQJC3';
  // identify your logged-in users (optional)
  Userback.user_data = {
    id: "123456", // example data
    info: {
      name: "someone", // example data
      email: "someone@example.com" // example data
    }
  };
  (function(d) {
    var s = d.createElement('script');s.async = true;s.src = 'https://static.userback.io/widget/v1.js';(d.head || d.body).appendChild(s);
  })(document);
</script>
</body>
</html>