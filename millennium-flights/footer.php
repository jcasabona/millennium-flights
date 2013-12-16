</div>
				
				
			
				
	<footer>
		<aside class="group">
			<?php if (!dynamic_sidebar('Sidebar2')) : ?>
			

			<?php endif; ?>
				</aside>		
		<?php if(ISMOBILE){ ?>
			<nav id="footernav">
				<?php wp_nav_menu( array('menu' => 'Main' )); ?>
			</nav>
		<?php } ?>
		
		
		<p>&copy; <a href="http://manifest-dev.org">Millennium Flights</a>, 2013.</p>
	</footer>
	
		</div>
		
		
		<?php wp_footer(); ?>
		
	</body>

</html>