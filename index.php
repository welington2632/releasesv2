<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since 1.0.0
 */

get_header();

?>

<div class="mastnavBar">	
	<div class="searchBar">
		<svg width="14" height="14" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M1.64407 6.98275C0.946624 3.77751 3.68352 0.971114 6.81011 1.68628C8.38533 2.04691 9.65729 3.35117 10.0097 4.96716C10.7087 8.17316 7.9688 10.9819 4.84295 10.2644C3.26698 9.903 1.99578 8.59874 1.64407 6.98275ZM13.3789 14.8618L9.9319 10.2125C11.2404 8.8792 11.9378 6.91633 11.5459 4.80828C11.11 2.46032 9.26575 0.564679 6.9752 0.113119C2.87694 -0.693731 -0.669172 2.93709 0.107261 7.1379C0.524539 9.39265 2.23537 11.2402 4.41192 11.7765C5.98714 12.1654 7.48413 11.8812 8.70913 11.163L12.1569 15.8146C12.3104 16.0209 12.598 16.0614 12.7999 15.904L13.291 15.5212C13.4929 15.3638 13.5324 15.0689 13.3789 14.8618Z" fill="#858585"></path>
		</svg>

		<input type="text" name="ofsearch" placeholder="Pesquisar" value="">
	</div>
</div>

<div class="modal__filter">
	<div class="modal__toggle open" onclick="toggleFilterBox()">
<!-- 		<svg width="14" class="modal__filter-close" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 1.41L1.41 0L7 5.59L12.59 0L14 1.41L8.41 7L14 12.59L12.59 14L7 8.41L1.41 14L0 12.59L5.59 7L0 1.41Z" fill="#FFF8F8"/>
		</svg> -->
		<svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V2H18V0H0ZM7 12H11V10H7V12ZM15 7H3V5H15V7Z" fill="white"/>
		</svg>

	</div>
	<div class="modal__content hide">
		<h4 class="modal__title"> Filtros avançados</h4>
		<section class="filter__section" id="data">
		<h4 class="filter__section-title">Data</h4>
			<div class="filter__itens">
			<div class="select__date">
				<select name="data_year">
					<option selected disabled> Ano </option>
					<option value="2020"> 2020 </option>
				</select>
			</div>

			<div class="select__date">
				<select name="data_month">
					<option selected disabled> Mês </option>
					<option value="01">Janeiro</option>
					<option value="02">Fevereiro</option>
					<option value="03">Março</option>
					<option value="04">Abril</option>
					<option value="05">Maio</option>
					<option value="06">Junho</option>
					<option value="07">Julho</option>
					<option value="08">Agosto</option>
					<option value="09">Setembro</option>
					<option value="10">Outubro</option>
					<option value="11">Novembro</option>
					<option value="12">Dezembro</option>
				</select>
			</div>
			</div>
		</section>
		<section class="filter__section" id="category">
		<h4 class="filter__section-title">Categorias</h4>
			<div class="filter__itens">
				<?php
					foreach (get_categories() as $category): ?>
						<div class="filter__item"> 
						<input type="checkbox" name="'.$category->term_id.'" onChange="checkCategoryFilter(this)"/>
						<label for="'.$category->term_id.'"><?=$category->term_name?></label>
						</div>';
				<?php
					endforeach;
				?>
			</div>
		</section>
		<section class="filter__section" id="products">
		<h4 class="filter__section-title">Aplicativos</h4>
			<div class="filter__itens">
				<?php
					$tags = get_tags(array(
						'hide_empty' => false
					));
					foreach ($tags as $tag) {
						echo '<div class="filter__item"> 
						<input type="checkbox" name="'.$tag->term_id.'" onChange="checkTagFilter(this)"/>
						<label for="'.$tag->term_id.'">'.$tag->name.'</label>
						</div>';
					}
				?>
			</div>
		</section>		
	</div>
</div>

<?php
	
global $wp_query;

$args = array(
	'category__or' => ['7'], // Posts que contenham as seguintes categorias (por id)
	'tag__in' => [], // Posts que contenham as seguintes tags (por id)
	'posts_per_page' => -1, // Mostra posts ilimitados
	'post_status' => 'publish',
	's' => '' // Termo de busca
);

$posts = get_posts($args);

if (count($posts) > 0) {

	// Load posts loop.
	foreach ($posts as $post) {
		?> <div class="post__divider"> <?php
		the_post();		

		get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
	?>
	
	<div class="post__content">
	<div class="post__date">
		<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
		<g clip-path="url(#clip0)">
		<path d="M31.9623 2.38899C31.893 1.11786 30.882 0.107052 29.6109 0.0376769C27.046 -0.102448 22.027 0.0338645 17.2278 2.51618C14.7812 3.78168 12.1937 5.92724 10.1288 8.40274C10.1033 8.43324 10.0786 8.46393 10.0533 8.49449L5.36708 8.85649C4.59571 8.91611 3.90865 9.32043 3.48202 9.96568L0.284896 14.8014C-0.038666 15.2908 -0.0901035 15.9032 0.147209 16.4397C0.384584 16.9762 0.872334 17.35 1.45202 17.4399L5.40021 18.0514C5.38627 18.1281 5.37227 18.2048 5.35946 18.2815C5.22802 19.0678 5.48852 19.8762 6.0564 20.444L11.5559 25.9435C12.0267 26.4144 12.6629 26.6739 13.3148 26.6739C13.449 26.6739 13.584 26.6629 13.7184 26.6404C13.7951 26.6276 13.8718 26.6136 13.9486 26.5997L14.5601 30.5479C14.6499 31.1276 15.0238 31.6154 15.5601 31.8527C15.7833 31.9515 16.0195 32.0002 16.2546 32.0002C16.5848 32.0002 16.9127 31.904 17.1985 31.7151L22.0342 28.5179C22.6795 28.0912 23.0838 27.4042 23.1433 26.6329L23.5053 21.9467C23.5358 21.9214 23.5666 21.8967 23.5971 21.8712C26.0726 19.8063 28.2183 17.2188 29.4837 14.7722C31.9662 9.97274 32.1022 4.95368 31.9623 2.38899ZM21.0001 26.9538L16.3745 30.0121L15.7785 26.1643C17.7335 25.5895 19.6674 24.6689 21.5098 23.4356L21.274 26.4884C21.2593 26.6788 21.1595 26.8485 21.0001 26.9538ZM12.8817 24.6177L7.38215 19.1182C7.24183 18.9778 7.17696 18.7806 7.20877 18.5907C7.37227 17.613 7.62634 16.6823 7.94083 15.8055L16.1926 24.0573C15.1396 24.4345 14.1964 24.6595 13.4092 24.7911C13.219 24.8227 13.022 24.758 12.8817 24.6177ZM5.51152 10.7259L8.56427 10.4901C7.3309 12.3326 6.41027 14.2665 5.83546 16.2215L1.98771 15.6256L5.04608 10.9998C5.15146 10.8404 5.32115 10.7406 5.51152 10.7259ZM22.3962 20.4313C20.8816 21.6946 19.4115 22.6084 18.0563 23.2696L8.73002 13.9432C9.59615 12.1742 10.6532 10.7012 11.5686 9.6038C13.4795 7.31286 15.8562 5.33655 18.0893 4.18155C22.4939 1.90324 27.1346 1.78055 29.5088 1.9098C29.8231 1.92693 30.073 2.17686 30.0902 2.49118C30.2196 4.86543 30.0966 9.50605 27.8183 13.9107C26.6634 16.1437 24.6871 18.5204 22.3962 20.4313Z" fill="#FD6000"/>
		<path d="M21.92 14.7652C23.1201 14.7651 24.3207 14.3082 25.2344 13.3945C26.1198 12.5092 26.6073 11.3321 26.6073 10.0801C26.6073 8.82806 26.1197 7.65094 25.2344 6.76562C23.4068 4.93794 20.433 4.93806 18.6055 6.76562C17.7202 7.65094 17.2326 8.82806 17.2326 10.0801C17.2326 11.3321 17.7202 12.5092 18.6055 13.3945C19.5194 14.3084 20.7194 14.7653 21.92 14.7652ZM19.9312 8.09137C20.4795 7.54306 21.1997 7.26894 21.9199 7.26894C22.6401 7.26894 23.3603 7.54306 23.9085 8.09137C24.4397 8.62256 24.7322 9.32881 24.7322 10.08C24.7322 10.8312 24.4397 11.5375 23.9085 12.0687C22.812 13.1652 21.0277 13.1652 19.9312 12.0687C19.4 11.5375 19.1074 10.8312 19.1074 10.0801C19.1074 9.32887 19.4 8.62256 19.9312 8.09137Z" fill="#FD6000"/>
		<path d="M0.956267 26.3711C1.1962 26.3711 1.43614 26.2796 1.61914 26.0965L4.67995 23.0357C5.04608 22.6696 5.04608 22.076 4.67995 21.7099C4.31389 21.3437 3.72027 21.3437 3.35414 21.7099L0.293393 24.7707C-0.0727324 25.1368 -0.0727324 25.7304 0.293393 26.0965C0.476393 26.2796 0.71633 26.3711 0.956267 26.3711Z" fill="#FD6000"/>
		<path d="M7.48528 24.5149C7.11921 24.1488 6.52559 24.1488 6.15946 24.5149L0.274838 30.3996C-0.0912871 30.7657 -0.0912871 31.3593 0.274838 31.7254C0.4579 31.9085 0.697775 32 0.937713 32C1.17765 32 1.41759 31.9085 1.60059 31.7254L7.48521 25.8407C7.8514 25.4746 7.8514 24.8811 7.48528 24.5149Z" fill="#FD6000"/>
		<path d="M8.96437 27.32L5.90356 30.3808C5.53744 30.7469 5.53744 31.3405 5.90356 31.7066C6.08662 31.8897 6.32656 31.9812 6.56644 31.9812C6.80631 31.9812 7.04631 31.8897 7.22931 31.7066L10.2901 28.6458C10.6562 28.2797 10.6562 27.6861 10.2901 27.32C9.92406 26.9539 9.33044 26.9539 8.96437 27.32Z" fill="#FD6000"/>
		</g>
		<defs>
		<clipPath id="clip0">
		<rect width="32" height="32" fill="white"/>
		</clipPath>
		</defs>
		</svg>

	<?php echo (get_the_date( 'd/m/Y' )) ?>
	</div>
		<?php the_content()?>
		</div>
		</div>
		<?php
	}

	// Previous/next page navigation.
	twenty_twenty_one_the_posts_navigation();

} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );

}

get_footer();
