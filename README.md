PHP-MVC Barebone Framework
==============


In Summary
--------------
Provides basic, barebone essentials to run a project quickly.

Live example: [http://php-mvc.mohdsufiyan.com/](http://php-mvc.mohdsufiyan.com/)


Why use this framework over others
--------------
- Flexible Controller
- User-friendly URLs
- Utilizes Composer to install dependancies
- Uses Twig with cache as a templating engine
- Seperation of concerns (like other MVC Frameworks)
- Utilizes Memcached (optional)
- Utilizes PHP PDO for prepared statement
- Simple, straight-forward, as per needs basis approach
- Built-in responsive design (follow the sample /application/views/ folder for inspiration

Flexible Controller
--------------
There are many ways that you can approach when designing your project depending on your requirement. Use the different scenarios without having to change any settings.

**Scenario 1:**
You just need to create a simple 5-page static website with just a single Controller to display 5 seperate pages. This can be easily achieved by having multiple methods in your application/controller/home.php as such:
	
	// URL: http://www.projectname.com/
	public function index()
    {
        $this->render('home', array(
			'metaTitle' => 'Hello World',
			'metaDescription' => 'This is the homepage'
		));
	}
	
	// URL: http://www.projectname.com/about-us/
	public function aboutUs()
    {
        $this->render('about-us', array(
			'metaTitle' => 'About Us page',
			'metaDescription' => 'This is the About Us page'
		));
	}
	
	// URL: http://www.projectname.com/our-services/
	public function ourServices()
    {
        $this->render('our-services', array(
			'metaTitle' => 'Our Services page',
			'metaDescription' => 'This is the Our Services page'
		));
	}

By using this approach, you just need a single Controller to display 5 Views.

**Scenario 2:**
Every page holds unique content and you need to seperate the Controllers. This can be easily achieved by simply creating multiple Controllers, each calling its own View as such:

Controller 1: home.php
	
	// URL: http://www.projectname.com/
	public function index()
    {
        $this->render('home', array(
			'metaTitle' => 'Hello World',
			'metaDescription' => 'This is the homepage'
		));
	}

Controller 2: aboutUs.php
	
	// URL: http://www.projectname.com/about-us/
	public function index()
    {
        $this->render('about-us', array(
			'metaTitle' => 'About Us page',
			'metaDescription' => 'This is the About Us page'
		));
	}
	
Controller 3: ourServices.php
	
	// URL: http://www.projectname.com/our-services/
	public function index()
    {
        $this->render('our-services', array(
			'metaTitle' => 'Our Services page',
			'metaDescription' => 'This is the Our Services page'
		));
	}

By using this approach, each "page" request has its own methods. This would be great for complex applications.
	
User-friendly URLs sample
--------------
	http://www.projectname.com/
	http://www.projectname.com/men/
	http://www.projectname.com/men/clothes/
	http://www.projectname.com/Basic-Short-Sleeve-Shirt-325