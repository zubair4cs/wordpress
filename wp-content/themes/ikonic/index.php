<?php
get_header();
 ?>
 <!-- Slider Start -->
 
<section class="section about">
	<div class="container">
		<div class="row">
		  <div class="col-lg-12 col-md-12">
				<div class="about-item">
					 <h4>Point 1 mail done and up[oad script on git </h4>
                     <h4>Point 2  mail done and up[oad script on git </h4>
                     <h4>Point 3  mail done and  write function for it in function.php line# 250 and hook ued for it template_redirect </h4>
                     <h4>Point 4  mail done  post type create and taxnomies n function.php line# 165 for post type and 205 for taxnimies </h4>
                     <h4pont 5 mail done archive page  link  is http://localhost/wordpress/project-type/test/</h4>
                     <p>tesrt is term </p> 
                     <h4>Point 6 mail done  you can test clck bellow button click </h4>
                     <p> 
                     <button class="navbar-toggler collapsed" type="button" id="my-button">  Click for ajax  </button>
          
                      <div id="projects-container"></div></p>
                     <h4>Point 7  not understandable statement </h4>
                     <h4>Point 8 mail is done check bellow code write functon in functon.php whhere  check logic </h4>
                      <p><?php 
						$i = 1;
						  $test = testapi();
					          foreach($test as  $testt){  echo $i.' '. $testt.'<br>'; $i++; }  ?></p> 
                     
					 
				</div>
			</div>
		</div>
	</div>
</section>
 
 

 
 
<section class="section cta">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<div class="cta-content bg-white p-5 rounded">
					<h3 class="mb-4">Assurance Service In Software<span class="text-color-primary"> Testing</span> </h3>
					<p class="mb-30">An Independent Validation and Testing services from SISAR. Helps to reduce software development efforts</p>
                    
                    
					
					<a href="project.html" class="btn btn-main">Portfolio<i class="fa fa-angle-right ml-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- section portfolio start -->
  
 <script type="text/javascript" >
 jQuery(document).ready(function($) {
    $('#my-button').on('click', function() {
        // Send AJAX request
        $.ajax({
            url: architectureProjectsAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'get_architecture_projects'
                
            },
			dataType: 'json', 
            success: function(response) {
                var projects = response.data;
                var output = '';
                
                projects.forEach(function(project) {
                    output += '<div class="project">';
                    output += '<h3>' + project.title + '</h3>';
                    output += '<a href="' + project.link + '">View Project</a>';
                    output += '</div>';
                });
                
                // Append the project details to a container on your page
                $('#projects-container').html(output);
			 
            },
            error: function() {
                alert('An error occurred');
            }
        });
    });
});

 </script>
 
 <?php get_footer(); ?>
 
 