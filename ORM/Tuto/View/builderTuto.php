<?php 
use Vendors\LandingPage\LandingPage;

$page = new LandingPage();
if($page->existPage()){
	$erno = $page->getPage();
}else{
	$erno = "brouillons";
}
?>
<div class="main-container-max">
	<!--<div id="containConfirm">
		<div id="confirmRemove">
			<p>Comfirmer la suppression</p>
			<button id="yesRemove">yes</button>
			<button id="noRemove">no</button>
		</div>
	</div>-->

	<div class="editor-commands">
		<a href="<?php echo DOMAINE.$erno ?>" class="retour2 cGris bold Iflex pl0">
			<svg class="mr10" version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
				<g>
					<g>
						<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
							s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
							C514.096,145.416,514.096,131.933,505.755,123.592z"/>
					</g>
				</g>
			</svg>
			<p class="mAuto txt12">Retour</p>
		</a>
	    <ul>
	        <li class="ECli1">
	        	<button data-command="undo">
	        		<div>
			        	<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
						<path class="st4" d="M33.6,29.7c-1.3-1.8-4.6-4.4-12.6-4.4c-0.2,0-0.4,0.2-0.4,0.4v3.8c0,0.3-0.4,0.5-0.7,0.3L13,22.7
							c-0.2-0.2-0.2-0.4,0-0.6l7-7c0.2-0.2,0.7-0.1,0.7,0.3v3.1c0,0.2,0.2,0.4,0.4,0.4c2,0.2,12,1.7,13.3,10.5
							C34.4,29.8,33.9,30,33.6,29.7z"/>
						</svg>
					</div>
				</button>
			</li>
	        <li class="ECli2">
	        	<button data-command="redo">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
							<path class="st4" d="M13.7,29.7c1.3-1.8,4.6-4.4,12.6-4.4c0.2,0,0.4,0.2,0.4,0.4v3.8c0,0.3,0.4,0.5,0.7,0.3l6.9-6.9
								c0.2-0.2,0.2-0.4,0-0.6l-7-7c-0.2-0.2-0.7-0.1-0.7,0.3v3.1c0,0.2-0.2,0.4-0.4,0.4c-2,0.2-12,1.7-13.3,10.5
								C12.9,29.8,13.5,30,13.7,29.7z"/>
						</svg>
					</div>
		        </button>
		    </li>
	        <li class="ECli3">
	        	<button data-command="bold">
	        		<div>
			        	<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
							<g>
								<path class="st4" d="M23.3,33.9c-1.1,0-2.2,0-3.3-0.1c-1.1-0.1-2.2-0.2-3.4-0.5V13.8c0.9-0.2,1.9-0.3,3.1-0.4
									c1.1-0.1,2.1-0.1,3.1-0.1c1.3,0,2.5,0.1,3.5,0.3c1.1,0.2,2,0.5,2.8,0.9c0.8,0.4,1.4,1,1.8,1.8c0.4,0.7,0.7,1.6,0.7,2.7
									c0,1.6-0.8,2.9-2.3,3.8c1.3,0.5,2.2,1.1,2.6,2c0.5,0.8,0.7,1.8,0.7,2.8c0,2.1-0.8,3.7-2.3,4.8C28.7,33.4,26.4,33.9,23.3,33.9z
									 M21,21.4h2.2c1.4,0,2.4-0.2,3-0.5c0.6-0.4,0.9-0.9,0.9-1.7c0-0.8-0.3-1.4-0.9-1.7c-0.6-0.3-1.5-0.5-2.7-0.5c-0.4,0-0.8,0-1.3,0
									c-0.4,0-0.8,0-1.2,0.1V21.4z M21,24.9v5.2c0.3,0,0.7,0.1,1.1,0.1s0.8,0,1.3,0c1.4,0,2.5-0.2,3.3-0.6s1.3-1.1,1.3-2.2
									c0-0.9-0.3-1.6-1-2c-0.7-0.4-1.7-0.6-3-0.6H21z"/>
							</g>
						</svg>
					</div>
		        </button>
		    </li>
	        <li class="ECli4">
	        	<button data-command="italic">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<path class="st4" d="M21.8,34.4h-2.7l3.6-15.1h2.7L21.8,34.4z M24.9,16.6c-0.4,0-0.8-0.1-1.1-0.4c-0.3-0.3-0.5-0.6-0.5-1.1
									c0-0.6,0.2-1.1,0.6-1.5s0.8-0.5,1.3-0.5c0.4,0,0.8,0.1,1.1,0.4c0.3,0.3,0.5,0.7,0.5,1.2c0,0.6-0.2,1.1-0.6,1.4
									C25.8,16.4,25.4,16.6,24.9,16.6z"/>
							</g>
						</svg>
					</div>
		        </button>
		    </li>
	        <li class="ECli5">
	        	<button data-command="underline">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
							<g>
								<path class="st4" d="M33.7,34h-19c-0.2,0-0.3,0.1-0.3,0.3v0.5c0,0.2,0.1,0.3,0.3,0.3h18.9c0.2,0,0.3-0.1,0.3-0.3v-0.5
									C34,34.1,33.8,34,33.7,34z"/>
								<path class="st4" d="M32.7,31.8c-0.7-1.8-1.3-3.5-1.9-5.1s-1.2-3-1.7-4.4c-0.6-1.4-1.1-2.7-1.7-4c-0.5-1.3-1.1-2.5-1.7-3.8
									l-0.1-0.3h-2.8l-0.1,0.3c-0.6,1.2-1.2,2.5-1.7,3.8s-1.1,2.6-1.7,4s-1.1,2.9-1.7,4.4c-0.6,1.6-1.2,3.2-1.9,5.1l-0.2,0.7H19l1.6-4.4
									h7.1c0.2,0.6,0.4,1.3,0.7,1.9c0.3,0.7,0.5,1.5,0.8,2.2l0.1,0.3H33L32.7,31.8z M26.6,25h-5c0.4-1.2,0.9-2.4,1.3-3.5
									c0.4-1,0.8-1.9,1.2-2.9c0.4,0.9,0.8,1.9,1.2,2.9C25.7,22.7,26.2,23.8,26.6,25z"/>
							</g>
						</svg>
					</div>
				</button>
			</li>
	        <li class="ECli6">
	        	<button data-command="strikeThrough">
	        		<div>
			        	<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
							<g>
								<path class="st4" d="M18.1,21.8h5.3c-0.4-0.1-0.7-0.3-1-0.4c-0.5-0.2-0.9-0.5-1.3-0.8s-0.7-0.6-0.9-1c-0.2-0.4-0.3-0.8-0.3-1.3
									s0.1-0.9,0.3-1.2c0.2-0.4,0.5-0.6,0.8-0.9c0.3-0.2,0.7-0.4,1.2-0.5s0.9-0.2,1.5-0.2c1,0,2,0.1,2.7,0.4c0.8,0.2,1.4,0.5,1.8,0.7
									l0.9-2.2c-0.5-0.3-1.2-0.6-2.1-0.8c-1-0.3-2.1-0.4-3.3-0.4c-2.1,0-3.7,0.5-4.9,1.5c-1.2,1-1.8,2.3-1.8,4c0,0.8,0.1,1.5,0.4,2.1
									C17.6,21.1,17.8,21.5,18.1,21.8z"/>
								<path class="st4" d="M29,25.2h-4.3c0.3,0.2,0.6,0.3,0.8,0.5c0.4,0.3,0.8,0.7,1,1.1c0.3,0.4,0.4,0.9,0.4,1.6c0,2-1.4,3-4.3,3
									c-1.3,0-2.4-0.2-3.3-0.5s-1.6-0.6-2-0.8l-0.8,2.3c0.2,0.1,0.5,0.3,0.9,0.4c0.4,0.2,0.8,0.3,1.3,0.5c0.5,0.1,1.1,0.3,1.8,0.4
									c0.7,0.1,1.4,0.2,2.1,0.2c2.3,0,4.1-0.5,5.3-1.4c1.3-0.9,1.9-2.3,1.9-4c0-0.9-0.1-1.7-0.4-2.4C29.3,25.7,29.2,25.5,29,25.2z"/>
								<g>
									<path class="st4" d="M33.4,22.9H16.2c-0.2,0-0.3,0.1-0.3,0.3v0.6c0,0.2,0.1,0.3,0.3,0.3h17.2c0.2,0,0.3-0.1,0.3-0.3v-0.6
										C33.7,23.1,33.6,22.9,33.4,22.9z"/>
								</g>
							</g>
						</svg>
					</div>
		        </button>
		    </li>
	        <li class="ECli7">
	        	<button data-command="removeFormat">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<path class="st4" d="M29.1,32.3H13.6c-0.2,0-0.3,0.1-0.3,0.3v0.6c0,0.2,0.1,0.3,0.3,0.3H29c0.2,0,0.3-0.1,0.3-0.3v-0.6
									C29.3,32.4,29.2,32.3,29.1,32.3z"/>
								<path class="st4" d="M36.7,35.8L30,29.1c-0.1-0.1-0.2-0.1-0.3,0l-0.5,0.5c-0.1,0.1-0.1,0.2,0,0.3l6.7,6.7c0.1,0.1,0.2,0.1,0.3,0
									l0.5-0.5C36.8,36,36.8,35.9,36.7,35.8z"/>
								<path class="st4" d="M30,36.6l6.7-6.7c0.1-0.1,0.1-0.2,0-0.3l-0.5-0.5c-0.1-0.1-0.2-0.1-0.3,0l-6.7,6.7c-0.1,0.1-0.1,0.2,0,0.3
									l0.5,0.5C29.8,36.7,29.9,36.7,30,36.6z"/>
								<polygon class="st4" points="21.7,30.9 24.4,30.9 24.4,16.5 30.5,16.5 30.5,14.1 15.6,14.1 15.6,16.5 21.7,16.5 	"/>
							</g>
						</svg>
					</div>
				</button>
			</li>
	        <li class="ECli8">
	        	<button data-command="html" data-command-argument="h2">
		        	<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<g>
									<g>
										<path class="st4" d="M30.5,13.7v2.6h-6.7v18.6h-3V16.3h-6.7v-2.6H30.5z"/>
									</g>
								</g>
								<g>
									<path class="st4" d="M26.9,24.2c0.7-0.3,1.5-0.7,2.2-1.1c0.7-0.4,1.3-1,1.9-1.7h1.3v13.5h-1.8v-11c-0.2,0.1-0.3,0.3-0.6,0.4
										s-0.5,0.3-0.7,0.4s-0.5,0.3-0.8,0.4c-0.3,0.1-0.6,0.2-0.8,0.3L26.9,24.2z"/>
								</g>
							</g>
						</svg>
					</div>
				</button>
			</li>
	        <li class="ECli9">
	        	<button data-command="html" data-command-argument="h3">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<g>
									<g>
										<path class="st4" d="M29.3,13.8v2.6h-6.8v18.9h-3V16.4h-6.8v-2.6H29.3z"/>
									</g>
								</g>
								<g>
									<path class="st4" d="M34.1,25.1c0,0.5-0.1,0.9-0.3,1.4c-0.2,0.4-0.4,0.9-0.8,1.3c-0.3,0.4-0.7,0.8-1.1,1.3
										c-0.4,0.4-0.8,0.8-1.2,1.2c-0.2,0.2-0.5,0.5-0.8,0.8c-0.3,0.3-0.6,0.6-0.8,0.9c-0.3,0.3-0.5,0.6-0.7,0.9c-0.2,0.3-0.3,0.6-0.3,0.8
										h6.3v1.6h-8.3c0-0.1,0-0.2,0-0.2c0-0.1,0-0.2,0-0.2c0-0.6,0.1-1.2,0.3-1.7c0.2-0.5,0.5-1,0.8-1.5c0.3-0.5,0.7-0.9,1.1-1.3
										c0.4-0.4,0.8-0.8,1.2-1.2c0.3-0.3,0.6-0.6,0.9-0.9c0.3-0.3,0.6-0.6,0.8-0.9c0.2-0.3,0.4-0.6,0.6-1c0.1-0.3,0.2-0.7,0.2-1
										c0-0.4-0.1-0.7-0.2-1c-0.1-0.3-0.3-0.5-0.5-0.7c-0.2-0.2-0.5-0.3-0.7-0.4c-0.3-0.1-0.6-0.1-0.9-0.1c-0.4,0-0.7,0.1-1,0.2
										c-0.3,0.1-0.6,0.2-0.8,0.4c-0.2,0.1-0.5,0.3-0.6,0.4c-0.2,0.2-0.3,0.3-0.4,0.3L26,22.9c0.1-0.1,0.3-0.3,0.5-0.5
										c0.2-0.2,0.5-0.4,0.8-0.5c0.3-0.2,0.7-0.3,1.1-0.4s0.8-0.2,1.3-0.2c1.4,0,2.5,0.3,3.2,1S34.1,23.9,34.1,25.1z"/>
								</g>
							</g>
						</svg>
					</div>
				</button>
			</li>
			 <li class="ECli11">
	        	<button data-command="insertUnorderedList">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<path class="st4" d="M36.4,16.6H16.8c-0.2,0-0.3,0.1-0.3,0.3v1.2c0,0.2,0.1,0.3,0.3,0.3h19.5c0.2,0,0.3-0.1,0.3-0.3v-1.2
									C36.7,16.8,36.5,16.6,36.4,16.6z"/>
								<circle class="st4" cx="12.4" cy="17.6" r="1.2"/>
								<path class="st4" d="M36.4,22.7H16.8c-0.2,0-0.3,0.1-0.3,0.3v1.2c0,0.2,0.1,0.3,0.3,0.3h19.5c0.2,0,0.3-0.1,0.3-0.3V23
									C36.7,22.8,36.5,22.7,36.4,22.7z"/>
								<circle class="st4" cx="12.4" cy="23.6" r="1.2"/>
								<path class="st4" d="M36.4,28.7H16.8c-0.2,0-0.3,0.1-0.3,0.3v1.2c0,0.2,0.1,0.3,0.3,0.3h19.5c0.2,0,0.3-0.1,0.3-0.3V29
									C36.7,28.8,36.5,28.7,36.4,28.7z"/>
								<circle class="st4" cx="12.4" cy="29.6" r="1.2"/>
							</g>
						</svg>
					</div>
		        </button>
		    </li>
	        <li class="ECli12">
	        	<button data-command="insertOrderedList">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<path class="st4" d="M36.4,16.4H16.5c-0.2,0-0.3,0.1-0.3,0.3V18c0,0.2,0.1,0.3,0.3,0.3h19.9c0.2,0,0.3-0.1,0.3-0.3v-1.3
									C36.7,16.5,36.5,16.4,36.4,16.4z"/>
								<path class="st4" d="M36.4,22.5H16.5c-0.2,0-0.3,0.1-0.3,0.3v1.3c0,0.2,0.1,0.3,0.3,0.3h19.9c0.2,0,0.3-0.1,0.3-0.3v-1.3
									C36.7,22.7,36.5,22.5,36.4,22.5z"/>
								<path class="st4" d="M36.4,28.6H16.5c-0.2,0-0.3,0.1-0.3,0.3v1.3c0,0.2,0.1,0.3,0.3,0.3h19.9c0.2,0,0.3-0.1,0.3-0.3V29
									C36.7,28.8,36.5,28.6,36.4,28.6z"/>
								<g>
									<g class="st4">
										<path class="st4" d="M12.2,16.6c0.1-0.1,0.3-0.1,0.4-0.2c0.1-0.1,0.3-0.2,0.4-0.3h0.2v2.6h-0.4v-2.1c0,0-0.1,0.1-0.1,0.1
											c0,0-0.1,0.1-0.1,0.1c-0.1,0-0.1,0.1-0.2,0.1s-0.1,0-0.2,0.1L12.2,16.6z"/>
									</g>
									<g class="st4">
										<path class="st4" d="M13.6,22.8c0,0.1,0,0.2-0.1,0.3c0,0.1-0.1,0.2-0.1,0.2c-0.1,0.1-0.1,0.2-0.2,0.2c-0.1,0.1-0.2,0.2-0.2,0.2
											c0,0-0.1,0.1-0.1,0.2c-0.1,0.1-0.1,0.1-0.2,0.2s-0.1,0.1-0.1,0.2c0,0.1-0.1,0.1-0.1,0.2h1.2v0.3h-1.6c0,0,0,0,0,0c0,0,0,0,0,0
											c0-0.1,0-0.2,0.1-0.3c0-0.1,0.1-0.2,0.2-0.3c0.1-0.1,0.1-0.2,0.2-0.3c0.1-0.1,0.2-0.2,0.2-0.2c0.1-0.1,0.1-0.1,0.2-0.2
											s0.1-0.1,0.2-0.2c0-0.1,0.1-0.1,0.1-0.2s0-0.1,0-0.2c0-0.1,0-0.1,0-0.2s-0.1-0.1-0.1-0.1c0,0-0.1-0.1-0.1-0.1c-0.1,0-0.1,0-0.2,0
											c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0-0.2,0.1c0,0-0.1,0.1-0.1,0.1c0,0-0.1,0.1-0.1,0.1L12,22.4c0,0,0.1-0.1,0.1-0.1
											c0,0,0.1-0.1,0.2-0.1c0.1,0,0.1-0.1,0.2-0.1c0.1,0,0.2,0,0.3,0c0.3,0,0.5,0.1,0.6,0.2C13.5,22.4,13.6,22.5,13.6,22.8z"/>
									</g>
									<g class="st4">
										<path class="st4" d="M12.7,30.6c0.2,0,0.4,0,0.5-0.1c0.1-0.1,0.1-0.2,0.1-0.4c0-0.1,0-0.2-0.1-0.2s-0.1-0.1-0.2-0.2
											s-0.1-0.1-0.2-0.1c-0.1,0-0.2,0-0.3,0h-0.1v-0.3h0.1c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2-0.1c0.1,0,0.1-0.1,0.1-0.1
											c0-0.1,0.1-0.1,0.1-0.2c0-0.1,0-0.1,0-0.2c0-0.1-0.1-0.1-0.1-0.1c0,0-0.1-0.1-0.1-0.1c-0.1,0-0.1,0-0.2,0c-0.1,0-0.2,0-0.3,0.1
											c-0.1,0-0.2,0.1-0.2,0.1l-0.1-0.3c0,0,0.1,0,0.1-0.1c0,0,0.1,0,0.2-0.1c0.1,0,0.1,0,0.2-0.1s0.1,0,0.2,0c0.1,0,0.3,0,0.4,0.1
											c0.1,0,0.2,0.1,0.2,0.1c0.1,0.1,0.1,0.1,0.1,0.2s0,0.2,0,0.3c0,0.1,0,0.3-0.1,0.3s-0.2,0.2-0.3,0.2c0.1,0,0.1,0,0.2,0.1
											c0.1,0,0.1,0.1,0.2,0.1s0.1,0.1,0.1,0.2c0,0.1,0,0.2,0,0.3c0,0.1,0,0.2-0.1,0.3c0,0.1-0.1,0.2-0.2,0.3c-0.1,0.1-0.2,0.1-0.3,0.2
											s-0.3,0.1-0.4,0.1c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0-0.2,0c0,0-0.1,0-0.1,0l0.1-0.3c0,0,0.1,0,0.2,0.1
											C12.4,30.6,12.5,30.6,12.7,30.6z"/>
									</g>
								</g>
							</g>
						</svg>
					</div>
				</button>
			</li>
	        <li class="ECli13">
	        	<button data-command="img">
	        		<div>
		        		<svg version="1.1" viewBox="0 0 48 48" xml:space="preserve">
			        		<g>
								<path class="st4" d="M36.4,14.1H11.6c-0.3,0-0.5,0.3-0.5,0.6v18.1c0,0.4,0.2,0.6,0.5,0.6h24.8c0.3,0,0.5-0.3,0.5-0.6V14.8
									C36.9,14.4,36.7,14.1,36.4,14.1z M34.7,30.4c0,0.3-0.2,0.5-0.4,0.5H13.7c-0.2,0-0.4-0.2-0.4-0.5V17.2c0-0.3,0.2-0.5,0.4-0.5h20.6
									c0.2,0,0.4,0.2,0.4,0.5V30.4z"/>
								<path class="st4" d="M21.7,28.1h9.4c0.3,0,0.5-0.3,0.3-0.6l-4.8-6.8c-0.2-0.2-0.5-0.2-0.6,0l-4.7,6.8
									C21.2,27.8,21.4,28.1,21.7,28.1z"/>
								<circle class="st4" cx="18.4" cy="21.2" r="2.1"/>
							</g>
						</svg>
					</div>
	        	</button>
	        </li>
	    </ul>
	</div>
	<!--<button id="draggableElement">Draggable elements</button>
	<button id="stopDraggableElement" style="display: none;">Retour Edition</button>-->
	<div class="form-tuto titre-tuto bgWhite" ajax="tuto" data="<?php echo $result['tuto']->getIdTuto() ?>">
		<?php 	echo $result["form"][1]->getForm(); ?>
	</div>
	<div class="form-tuto image-tuto bgWhite" ajax="tuto" data="<?php echo $result['tuto']->getIdTuto() ?>">
		<div class="flex">
			<div>
				<p class="mb10 txt18 bold">Sélectionnez une image de présentation</p>
				<p class="mb0">Celle-ci et l’intitulé seront les premiers éléments visible par les internautes avant de clicker sur votre tutoriel, nous vous recommandons donc de mettre la ﬁnalité de votre création.</p>
			</div>
			<?php 	echo $result["form"][2]->getForm(); ?>
		</div>
		<?php if(!is_null($result["tuto"]->getVisuelTuto())): ?>
			<div class="flex pt40">
				<img class="mAuto imgVisuTuto" src="medias/chaine/id-<?php echo $_SESSION['authChaine']['id'] ?>/tuto-<?php echo $result['tuto']->getIdTuto() ?>/<?php echo $result['tuto']->getVisuelTuto() ?>" alt="">
			</div>
		<?php endif; ?>
	</div>
	<div class="form-tuto cat-tuto bgWhite flex fdC" ajax="tuto" data="<?php echo $result['tuto']->getIdTuto() ?>">
		<div>
			<p class="mb10 txt18 bold">Sélectionnez des catégories</p>
			<p>Les catégories sont très utiles aux utilisateur pour ﬁltrer meur recherche et que vous apparaissiez.</p>
			<div class="mb20">
				<button class="btnV" modale='btn-proposition'><p class="txt12">nouvelle catégorie</p></button>
			</div>
			<?php if(isset($result['props'])): ?>
				<div class="mb20">
					<p class="mb10">Nouvelle(s) catégorie(s) :</p>
					<?php foreach ($result['props'] as $prop):?>
						<div class="catProp">
							<p class="mb0 cBleu bold"><?php echo $prop->getTitreProposition() ?></p>
							<div class="removeCatProp" ajax="rm-prop" datas="<?php echo $prop->getIdProposition() ?>"></div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php 	echo $result["form"][3]->getForm(); ?>
	</div>
	<div class="finForm mt40">
		<p class="mb10 m0Auto">Maintenant, c’est à vous de jouer !</p>
		<svg version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
			<g>
				<g>
					<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
						s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
						C514.096,145.416,514.096,131.933,505.755,123.592z"/>
				</g>
			</g>
		</svg>
	</div>
	
	<div id="zoneMore" data="<?php echo $result['tuto']->getIdTuto() ?>">
		<?php if(!is_null($result["tuto"]->getHtmlTuto())): ?>
				<?php echo $result["tuto"]->getHtmlTuto(); ?>
		<?php else: ?>
	    <div class="row">
	    	<div class="moreCol">
	        	<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
					<g>
						<g>
							<rect x="8.5" y="14" class="st0" width="15" height="2.1"/>
							<rect x="8.5" y="9" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/>
						</g>
					</g>
				</svg>
	        </div>
	        <div class="col">
	        	<div class='intoCol'>
		        	<div class="removeCol"></div>
		        	<div contenteditable="true" spellcheck="false"  data-text="Éditer du texte"></div>
		        </div>
	        </div>
	    </div>
	 <?php endif; ?>
	</div>
</div>
<div id="moreRow"><p class="mb0">Ajouter une ligne</p></div>
<div id="modale-selectFile">
	<div data="<?php echo $result['tuto']->getIdTuto() ?>">
		<button class="retour1 cWhite bold flex pl0">
			<svg class="mr10" version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
				<g>
					<g>
						<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
							s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
							C514.096,145.416,514.096,131.933,505.755,123.592z"/>
					</g>
				</g>
			</svg>
			<p class="mAuto txt12">Retour</p>
		</button>
		<div class="flex fdC">
			<p class="titre2 mb40 alignCenter">Ajouter une image</p>
			<p class="mb5 mb80">Sélèctionner un fichier .jpg ou .png (max 2mo) et charger l'image.</p>
			<!--<p class="mb80">Taile de l'image conseillé <span class="bold">2100x350<span></p>-->
			<?php echo $result["form"][4]->getForm(); ?>
		</div>
	</div>
</div>
<div id="modale-proposition">
		<div>
			<button class="retour1 cWhite bold flex pl0">
				<svg class="mr10" version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
					<g>
						<g>
							<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
								s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
								C514.096,145.416,514.096,131.933,505.755,123.592z"/>
						</g>
					</g>
				</svg>
				<p class="mAuto txt12">Retour</p>
			</button>
			<div>
				<p class="titre2 mb60 alignCenter">Intitulé de la catégorie</p>
				<p class="mb5">La catégorie sera traité en amont de sa publication.</p>
				<p class="mb60 bold">Suite à sa vérification elle sera automatiquement associé à votre contenu.</p>
				<?php echo $result["form"][5]->getForm(); ?>
				<p class="cGris txt12 mt-20">Si vous souhaitez renseigner plusieurs catégories, veuillez répéter l'opération.</p>
			</div>
		</div>
	</div>

<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-ui.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxTitreTuto.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxVisuelTuto.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxCatTuto.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxHtmlTuto.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/select.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/BuilderTuto.js"></script>