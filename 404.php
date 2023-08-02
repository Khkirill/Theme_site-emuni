<?php
$path = get_template_directory();
get_header() ?>
<main class="not-found">
	<div class="container row">
		<h2 class="not-found__404">404</h2>
		<h1>Sorry page not found</h1>
		<a href="/" class="btn btn_blue">Go to the main page</a>
	</div>
</main>
<style>
		.not-found{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
			height:80vh;
		}
        .not-found h1{
            margin-bottom: 50px;
        }
        .not-found .row{
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }
        .not-found__404 {
            font-size: 200px;
            font-weight: 600;
            line-height: 1;
        }
</style>
<?php get_footer() ?>