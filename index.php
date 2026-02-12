<?php
require __DIR__ . '/includes/config.php';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$featuredTours = [];

try {
    $statement = $pdo->prepare('SELECT id, title, location, category, price, rating, image FROM tours ORDER BY rating DESC, id DESC LIMIT 6');
    $statement->execute();
    $featuredTours = $statement->fetchAll();
} catch (PDOException $e) {
    $featuredTours = [];
}

if (!$featuredTours) {
    $featuredTours = [
        [
            'id' => 1,
            'title' => 'Sunrise City Highlights Tour',
            'location' => 'Lisbon, Portugal',
            'category' => 'City Tours',
            'price' => '89.00',
            'rating' => '4.8',
            'image' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 2,
            'title' => 'Coastal Adventure Kayak Experience',
            'location' => 'Dubrovnik, Croatia',
            'category' => 'Adventure',
            'price' => '120.00',
            'rating' => '4.9',
            'image' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'id' => 3,
            'title' => 'Taste of the Old Town Food Walk',
            'location' => 'Mexico City, Mexico',
            'category' => 'Food & Drink',
            'price' => '65.00',
            'rating' => '4.7',
            'image' => 'https://images.unsplash.com/photo-1498654896293-37aacf113fd9?auto=format&fit=crop&w=1200&q=80',
        ],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voyago Tours | Discover unforgettable experiences</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <div class="container nav-wrapper">
      <a class="logo" href="index.php">Voyago</a>
      <button class="nav-toggle" type="button" aria-label="Toggle navigation" data-nav-toggle>
        <span></span>
        <span></span>
        <span></span>
      </button>
      <nav class="nav-links" data-nav-links>
        <a href="index.php" class="active">Home</a>
        <a href="tours.php">Tours</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="container hero-content">
        <div>
          <span class="badge">Explore top-rated experiences</span>
          <h1>Find your next tour, attraction, or adventure.</h1>
          <p>Search thousands of guided tours, food tastings, and outdoor experiences from trusted local hosts.</p>
          <form class="search-bar" data-search-form>
            <input type="text" name="search" placeholder="Search tours or destinations..." aria-label="Search tours" data-search-input>
            <button type="submit">Search</button>
          </form>
          <p class="helper-text">Popular: Rome food tours, Bali waterfalls, NYC skyline</p>
        </div>
        <div class="hero-card">
          <h3>Why book with Voyago?</h3>
          <ul>
            <li>Free cancellation options</li>
            <li>Trusted local guides</li>
            <li>Verified traveler reviews</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="categories">
      <div class="container">
        <div class="section-heading">
          <h2>Featured categories</h2>
          <p>Hand-picked experiences based on what travelers love.</p>
        </div>
        <div class="category-grid">
          <article class="category-card">
            <h3>City Tours</h3>
            <p>Walk historic neighborhoods, markets, and landmarks.</p>
          </article>
          <article class="category-card">
            <h3>Adventure</h3>
            <p>Hiking, kayaking, and adrenaline-filled escapes.</p>
          </article>
          <article class="category-card">
            <h3>Food & Drink</h3>
            <p>Tastings, cooking classes, and chef-led experiences.</p>
          </article>
          <article class="category-card">
            <h3>Nature</h3>
            <p>National parks, wildlife, and scenic getaways.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="featured-tours">
      <div class="container">
        <div class="section-heading">
          <h2>Featured tours</h2>
          <p>Top-rated experiences pulled directly from our database.</p>
        </div>
        <div class="tour-grid" data-tour-grid>
          <?php foreach ($featuredTours as $tour): ?>
            <article class="tour-card" data-tour-card>
              <img src="<?php echo e($tour['image']); ?>" alt="<?php echo e($tour['title']); ?>">
              <div class="tour-card-body">
                <div>
                  <h3><?php echo e($tour['title']); ?></h3>
                  <p class="tour-meta"><?php echo e($tour['location']); ?> • <?php echo e($tour['category']); ?></p>
                </div>
                <div class="tour-footer">
                  <span class="rating" data-rating="<?php echo e((string) $tour['rating']); ?>">
                    <span class="stars"></span>
                    <?php echo e((string) $tour['rating']); ?>
                  </span>
                  <span class="price">$<?php echo e((string) $tour['price']); ?></span>
                </div>
                <a class="btn" href="tour.php?id=<?php echo e((string) $tour['id']); ?>">View Details</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container">
      <p>© <?php echo date('Y'); ?> Voyago Tours. All rights reserved.</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
