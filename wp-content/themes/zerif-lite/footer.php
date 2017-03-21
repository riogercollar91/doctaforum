<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 */

?>


</div><!-- .site-content -->




<?php zerif_before_footer_trigger(); ?>

	<!-- sesion testimonios -->

<section id="testi">
<div id="testimonios">
	<h2 class="dark-text-testimonios"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Testimonios";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Testimonials";
	endif;
?></h2>
	<div data-scrollreveal="enter right after 0s over 3s">
		 <?php echo do_shortcode("[pt_view id=5ebe930srl]"); ?>
	</div>
  <!--  <img class="hidden-xs" src="http://www.doctaforum.com/wp-content/themes/responsiveboat/images/clientes.jpg" width="960" height="640" />
   <img class="visible-xs" src="http://www.doctaforum.com/wp-content/themes/responsiveboat/images/clientes-movil.jpg" /> -->
 </div>


<!-- sesion testimonios -->
</section>

<!-- <section id="blog">
<div  class="" data-scrollreveal="enter top after 0s over 3s">
	<h2 class="dark-text-blog"> -->
		<?php 
	//if($GLOBALS['q_config']['language']=='es'):
	// 	echo "Actualidad";
	// endif;
	// if($GLOBALS['q_config']['language']=='en'):
	// 	echo "Present";
	// endif;
	// if($GLOBALS['q_config']['language']=='ca'):
	// 	echo "Actualitat";
	// endif;
?>
<!-- </h2> -->
	<?php // echo do_shortcode("[pt_view id=2f27373149]"); ?>

<!-- </div>
</section> -->


<section id="formulario-contacto">
<h2 class="dark-text white"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Contáctenos";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Contact Us";
	endif;
?></h2>
	<?php echo do_shortcode('[contact-form-7 id="127" title="Formulario de contacto 1"]');?>
</section>


<section id="contacto-mapa">
	<div id="mapa">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d901.9484652825614!2d-3.6983948474799644!3d40.502227224098604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422bda3dd47967%3A0xd6c86722f10b04a2!2sDoctaforum!5e0!3m2!1ses!2ses!4v1489143784970" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen ></iframe>
	</div>

</section>

<footer id="footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

	<?php zerif_footer_widgets_trigger(); ?>

	<div class="container">

		<?php zerif_top_footer_trigger(); ?>

		<?php
			$footer_sections = 0;
			$zerif_address = get_theme_mod( 'zerif_address',apply_filters( 'zerif_address_default_filter', __('Company address','zerif-lite') ) );
			$zerif_address_icon = get_theme_mod( 'zerif_address_icon',apply_filters( 'zerif_address_icon_default_filter', get_template_directory_uri().'/images/map25-redish.png' ) );

			$zerif_email = get_theme_mod( 'zerif_email',apply_filters( 'zerif_email_default_filter','<a href="mailto:contact@site.com">contact@site.com</a>' ) );
			$zerif_email_icon = get_theme_mod( 'zerif_email_icon',apply_filters( 'zerif_email_icon_default_filter',get_template_directory_uri().'/images/envelope4-green.png' ) );

			$zerif_phone = get_theme_mod( 'zerif_phone',apply_filters( 'zerif_phone_default_filter','<a href="tel:0 332 548 954">0 332 548 954</a>' ) );
			$zerif_phone_icon = get_theme_mod( 'zerif_phone_icon',apply_filters( 'zerif_phone_icon_default_filter',get_template_directory_uri().'/images/telephone65-blue.png' ) );

			$zerif_socials_facebook = get_theme_mod( 'zerif_socials_facebook','#' );
			$zerif_socials_twitter = get_theme_mod( 'zerif_socials_twitter','#' );
			$zerif_socials_linkedin = get_theme_mod( 'zerif_socials_linkedin','#' );
			$zerif_socials_behance = get_theme_mod( 'zerif_socials_behance','#' );
			$zerif_socials_dribbble = get_theme_mod( 'zerif_socials_dribbble','#' );
			$zerif_socials_instagram = get_theme_mod( 'zerif_socials_instagram' );

			$zerif_accessibility = get_theme_mod('zerif_accessibility');
			$zerif_copyright = get_theme_mod('zerif_copyright');

			if(!empty($zerif_address) || !empty($zerif_address_icon)):
				$footer_sections++;
			endif;

			if(!empty($zerif_email) || !empty($zerif_email_icon)):
				$footer_sections++;
			endif;

			if(!empty($zerif_phone) || !empty($zerif_phone_icon)):
				$footer_sections++;
			endif;
			if( !empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble) ||
			!empty($zerif_copyright) || !empty($zerif_socials_instagram) ):
				$footer_sections++;
			endif;

			if( $footer_sections == 1 ):
				$footer_class = 'col-md-12';
			elseif( $footer_sections == 2 ):
				$footer_class = 'col-md-6';
			elseif( $footer_sections == 3 ):
				$footer_class = 'col-md-4';
			elseif( $footer_sections == 4 ):
				$footer_class = 'col-md-3';
			else:
				$footer_class = 'col-md-3';
			endif;

			if( !empty($footer_class) ) {

				/* COMPANY ADDRESS */
				if( !empty($zerif_address_icon) || !empty($zerif_address) ) {
					echo '<div class="'.$footer_class.' company-details">';

						if( !empty($zerif_address_icon) ) {
							echo '<div class="icon-top red-text">';
								 echo '<img src="'.esc_url($zerif_address_icon).'" alt="" />';
							echo '</div>';
						}

						if( !empty($zerif_address) ) {
							echo '<div class="zerif-footer-address">';
								echo wp_kses_post( $zerif_address );
							echo '</div>';
						} else if( is_customize_preview() ) {
							echo '<div class="zerif-footer-address zerif_hidden_if_not_customizer"></div>';
						}

					echo '</div>';
				}

				/* COMPANY EMAIL */
				if( !empty($zerif_email_icon) || !empty($zerif_email) ) {
					echo '<div class="'.$footer_class.' company-details">';

						if( !empty($zerif_email_icon) ) {
							echo '<div class="icon-top green-text">';
								echo '<img src="'.esc_url($zerif_email_icon).'" alt="" />';
							echo '</div>';
						}
						if( !empty($zerif_email) ) {
							echo '<div class="zerif-footer-email">';
								echo wp_kses_post( $zerif_email );
							echo '</div>';
						} else if( is_customize_preview() ) {
							echo '<div class="zerif-footer-email zerif_hidden_if_not_customizer"></div>';
						}

					echo '</div>';
				}

				/* COMPANY PHONE NUMBER */
				if( !empty($zerif_phone_icon) || !empty($zerif_phone) ) {
					echo '<div class="'.$footer_class.' company-details">';
						if( !empty($zerif_phone_icon) ) {
							echo '<div class="icon-top blue-text">';
								echo '<img src="'.esc_url($zerif_phone_icon).'" alt="" />';
							echo '</div>';
						}
						if( !empty($zerif_phone) ) {
							echo '<div class="zerif-footer-phone">';
								echo wp_kses_post( $zerif_phone );
							echo '</div>';
						} else if( is_customize_preview() ) {
							echo '<div class="zerif-footer-phone zerif_hidden_if_not_customizer"></div>';
						}
					echo '</div>';
				}
			}

			// open link in a new tab when checkbox "accessibility" is not ticked
			$attribut_new_tab = (isset($zerif_accessibility) && ($zerif_accessibility != 1) ? ' target="_blank"' : '' );

			if( !empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble) ||
			!empty($zerif_copyright) || !empty($zerif_socials_instagram) ):

						echo '<div class="'.$footer_class.' copyright">';
						if(!empty($zerif_socials_facebook) || !empty($zerif_socials_twitter) || !empty($zerif_socials_linkedin) || !empty($zerif_socials_behance) || !empty($zerif_socials_dribbble)):
							echo '<ul class="social">';

							/* facebook */
							if( !empty($zerif_socials_facebook) ):
								echo '<li><a'.$attribut_new_tab.' href="'.esc_url($zerif_socials_facebook).'"><span class="sr-only">' . __( 'Go to Facebook', 'zerif-lite' ) . '</span> <i class="fa fa-facebook fa-2x color1"></i></a></li>';
							endif;
							/* twitter */
							if( !empty($zerif_socials_twitter) ):
								echo '<li><a'.$attribut_new_tab.' href="'.esc_url($zerif_socials_twitter).'"><span class="sr-only">' . __( 'Go to Twitter', 'zerif-lite' ) . '</span> <i class="fa fa-twitter fa-2x color2"></i></a></li>';
							endif;
							/* linkedin */
							if( !empty($zerif_socials_linkedin) ):
								echo '<li><a'.$attribut_new_tab.' href="'.esc_url($zerif_socials_linkedin).'"><span class="sr-only">' . __( 'Go to Linkedin', 'zerif-lite' ) . '</span> <i class="fa fa-linkedin fa-2x color3"></i></a></li>';
							endif;
							/* behance */
							if( !empty($zerif_socials_behance) ):
								echo '<li><a'.$attribut_new_tab.' href="'.esc_url($zerif_socials_behance).'"><span class="sr-only">' . __( 'Go to Behance', 'zerif-lite' ) . '</span> <i class="fa fa-behance"></i></a></li>';
							endif;
							/* dribbble */
							if( !empty($zerif_socials_dribbble) ):
								echo '<li><a'.$attribut_new_tab.' href="'.esc_url($zerif_socials_dribbble).'"><span class="sr-only">' . __( 'Go to Dribble', 'zerif-lite' ) . '</span> <i class="fa fa-dribbble"></i></a></li>';
							endif;
							/* instagram */
							if( !empty($zerif_socials_instagram) ):
								echo '<li><a'.$attribut_new_tab.' href="'.esc_url($zerif_socials_instagram).'"><span class="sr-only">' . __( 'Go to Instagram', 'zerif-lite' ) . '</span> <i class="fa fa-instagram"></i></a></li>';
							endif;
							echo '</ul>';
						endif;

						if( !empty($zerif_copyright) ):
							echo '<p id="zerif-copyright">'.wp_kses_post($zerif_copyright).'</p>';
						elseif( is_customize_preview() ):
							echo '<p id="zerif-copyright" class="zerif_hidden_if_not_customizer"></p>';
						endif;

						echo '<div class="zerif-copyright-box"><a class="zerif-copyright" href="http://themeisle.com/themes/zerif-lite/"'.$attribut_new_tab.' rel="nofollow">Zerif Lite </a>'.__('powered by','zerif-lite').'<a class="zerif-copyright" href="http://wordpress.org/"'.$attribut_new_tab.' rel="nofollow"> WordPress</a></div>';

						echo '</div>';

			endif;
		?>
		<?php zerif_bottom_footer_trigger(); ?>
	</div> <!-- / END CONTAINER -->

</footer> <!-- / END FOOOTER  -->

<div id="extra-footer">
	<a id="copy">© Doctaforum 2017</a>
	<a href="#" data-toggle="modal" data-target="#modalcookie1"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Aviso legal y Condiciones de Uso";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Legal notice and conditions of use";
	endif;
?></a>
	<a href="#" data-toggle="modal" data-target="#modalcookie2" target="_blank"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Política de Cookies";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Cookies policy";
	endif;
?></a>

<!-- modal-->
<div class="modal fade" id="modalcookie1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Aviso legal y Condiciones de Uso";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Legal notice and conditions of use";
	endif;
?></h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="spanclose">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
   <div class="row"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Condiciones de uso En cumplimiento de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSI-CE), DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informa que es titular del sitio web doctaforum.com, doctaforum.net. De acuerdo con la exigencia del artículo 10 de la citada Ley, DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informa de los siguientes datos: El titular de este sitio web es DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, con CIF B82236464 y domicilio social en C/ MONASTERIO DE YUSO Y SUSO 34 OFI 4-14-2 28049, MADRID, inscrita en el Registro Mercantil, en el tomo20532, folio 121, hoja M-363490 e inscripción Primera. La dirección de correo electrónico de contacto con la empresa es: info@doctaforum.com. USUARIO Y RÉGIMEN DE RESPONSABILIDADES La navegación, acceso y uso por el sitio web de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L confiere la condición de usuario, por la que se aceptan, desde la navegación por el sitio web de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, todas las condiciones de uso aquí establecidas sin perjuicio de la aplicación de la correspondiente normativa de obligado cumplimiento legal según el caso. El sitio web de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L proporciona gran diversidad de información, servicios y datos. El usuario asume su responsabilidad en el uso correcto del sitio web. Esta responsabilidad se extenderá a: - La veracidad y licitud de las informaciones aportadas por el usuario en los formularios extendidos por DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.Lara el acceso a ciertos contenidos o servicios ofrecidos por el web. - El uso de la información, servicios y datos ofrecidos por DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L contrariamente a lo dispuesto por las presentes condiciones, la Ley, la moral, las buenas costumbres o el orden público, o que de cualquier otro modo puedan suponer lesión de los derechos de terceros o del mismo funcionamiento del sitio web. POLÍTICA DE ENLACES Y EXENCIONES DE RESPONSABILIDAD DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L no se hace responsable del contenido de los sitios web a los que el usuario pueda acceder a través de los enlaces establecidos en su sitio web y declara que en ningún caso procederá a examinar o ejercitar ningún tipo de control sobre el contenido de otros sitios de la red. Asimismo, tampoco garantizará la disponibilidad técnica, exactitud, veracidad, validez o legalidad de sitios ajenos a su propiedad a los que se pueda acceder por medio de los enlaces. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L declara haber adoptado todas las medidas necesarias para evitar cualquier daño a los usuarios de su sitio web, que pudieran derivarse de la navegación por su sitio web. En consecuencia, DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L no se hace responsable, en ningún caso, de los eventuales daños que por la navegación por Internet pudiera sufrir el usuario. MODIFICACIONES DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L se reserva el derecho a realizar las modificaciones que considere oportunas, sin aviso previo, en el contenido de su sitio web. Tanto en lo referente a los contenidos del sitio web, como en las condiciones de uso del mismo. Dichas modificaciones podrán realizarse a través de su sitio web por cualquier forma admisible en derecho y serán de obligado cumplimiento durante el tiempo en que se encuentren publicadas en la web y hasta que no sean modificadas válidamente por otras posteriores. SERVICIOS DE RESERVA POR INTERNET Ciertos contenidos de la website de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L contienen la posibilidad de reservar por Internet. El uso de los mismos requerirá la lectura y aceptación obligatoria de las condiciones generales de reserva establecidas al efecto por DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. PROTECCIÓN DE DATOS De conformidad con lo que establece la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal (LOPD), DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informa a los usuarios de su sitio web que los datos personales recabados por la empresa, mediante los formularios sitos en sus páginas, serán introducidos en un fichero automatizado bajo la responsabilidad de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, con la finalidad de poder facilitar, agilizar y cumplir los compromisos establecidos entre ambas partes. Asimismo,DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informa de la posibilidad de ejercer los derechos de acceso, rectificación, cancelación y oposición mediante un escrito a la dirección: C/ MONASTERIO DE YUSO Y SUSO 34 OFI 4-14-2 28049, MADRID. Mientras el usuario no comunique lo contrario a DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, ésta entenderá que sus datos no han sido modificados, que el usuario se compromete a notificar a DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L cualquier variación y que DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L tiene el consentimiento para utilizarlos a fin de poder fidelizar la relación entre las partes. PROPIEDAD INTELECTUAL E INDUSTRIAL DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L por sí misma o como cesionaria, es titular de todos los derechos de propiedad intelectual e industrial de su página web, así como de los elementos contenidos en la misma (a título enunciativo, imágenes, sonido, audio, vídeo, software o textos; marcas o logotipos, combinaciones de colores, estructura y diseño, selección de materiales usados, programas de ordenador necesarios para su funcionamiento, acceso y uso, etc.), titularidad de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. Serán, por consiguiente, obras protegidas como propiedad intelectual por el ordenamiento jurídico español, siéndoles aplicables tanto la normativa española y comunitaria en este campo, como los tratados internacionales relativos a la materia y suscritos por España. Todos los derechos reservados. En virtud de lo dispuesto en los artículos 8 y 32.1, párrafo segundo, de la Ley de Propiedad Intelectual, quedan expresamente prohibidas la reproducción, la distribución y la comunicación pública, incluida su modalidad de puesta a disposición, de la totalidad o parte de los contenidos de esta página web, con fines comerciales, en cualquier soporte y por cualquier medio técnico, sin la autorización de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. El usuario se compromete a respetar los derechos de Propiedad Intelectual e Industrial titularidad de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. Podrá visualizar los elementos del portal e incluso imprimirlos, copiarlos y almacenarlos en el disco duro de su ordenador o en cualquier otro soporte físico siempre y cuando sea, única y exclusivamente, para su uso personal y privado. El usuario deberá abstenerse de suprimir, alterar, eludir o manipular cualquier dispositivo de protección o sistema de seguridad que estuviera instalado en las páginas de DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. ACCIONES LEGALES, LEGISLACIÓN APLICABLE Y JURISDICCIÓN DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L se reserva, asimismo, la facultad de presentar las acciones civiles o penales que considere oportunas por la utilización indebida de su sitio web y contenidos, o por el incumplimiento de las presentes condiciones. La relación entre el usuario y el prestador se regirá por la normativa vigente y de aplicación en el territorio español. De surgir cualquier controversia las partes podrán someter sus conflictos a arbitraje o acudir a la jurisdicción ordinaria cumpliendo con las normas sobre jurisdicción y competencia al respecto. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L tiene su domicilio en MADRID, España. ";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Conditions of use In compliance with Law 34/2002, of July 11, on Services of the Information Society and Electronic Commerce (LSSI-CE), DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L reports that it owns the website doctaforum.com, doctaforum .net. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L announces the following information: The owner of this website is DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, with CIF B82236464 and registered office in C / MONASTERIO DE YUSO Y SUSO 34 OFI 4 -14-2 28049, MADRID, registered in the Mercantile Register, in tome20532, folio 121, sheet M-363490 and inscription First. The email address of contact with the company is: info@doctaforum.com. USER AND RESPONSIBILITY REGIME The navigation, access and use by the website of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L confers the condition of user, by which, from the navigation through the website of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, all the conditions of use established herein Without prejudice to the application of the corresponding regulations of legal compliance as the case may be. The DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L website provides a wide range of information, services and data. The user assumes his responsibility in the correct use of the website. This responsibility will be extended to: - The veracity and legality of the information provided by the user in the forms extended by DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.Lara the access to certain contents or services offered by the web. - The use of the information, services and data offered by DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L contrary to the provisions of the present conditions, the Law, morality, good customs or public order, or that in any other way may imply damage of the rights Third party or the same operation of the website. POLICY OF LINKS AND EXEMPTIONS OF RESPONSIBILITY DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L is not responsible for the content of the websites to which the user can access through the links established in its website and states that in no case will proceed to examine or exercise any type Control over the content of other sites on the network. Likewise, it will not guarantee the technical availability, accuracy, truthfulness, validity or legality of sites outside of your property that can be accessed through the links. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L declares that it has taken all necessary measures to avoid any damage to the users of its website, which could be derived from browsing its website. Consequently, DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L is not responsible, in any case, for any damages that the user may experience on the Internet. MODIFICATIONS DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L reserves the right to make the modifications that it deems appropriate, without prior notice, in the content of its website. Both in terms of the contents of the website, and in the conditions of use of the same. Such modifications may be made through its website by any form admissible in law and will be enforced during the time they are published on the web and until they are validly modified by later ones. INTERNET RESERVATION SERVICES Certain contents of the DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L website contain the possibility of booking on the Internet. The use of these will require the reading and mandatory acceptance of the general booking conditions established for this purpose by DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. DATA PROTECTION In accordance with the Organic Law 15/1999 on Personal Data Protection (LOPD), DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informs users of its website that the personal data collected by the company, through the forms In their pages, will be entered in an automated file under the responsibility of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, in order to facilitate, expedite and fulfill the commitments established between both parties. Likewise, DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informs the possibility of exercising the rights of access, rectification, cancellation and opposition by means of a writing to the address: C / MONASTERIO DE YUSO Y SUSO 34 OFI 4-14-2 28049, MADRID. As long as the user does not communicate to DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, it will understand that their data has not been modified, that the user undertakes to notify DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L of any variation and that DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L has the consent to use them in order to be able to retain The relationship between the parties. INTELLECTUAL AND INDUSTRIAL PROPERTY DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L by itself or as a transferee, is the owner of all intellectual and industrial property rights of its website, as well as of the elements contained in it (by way of example, images, sound, audio, Video, software or texts, trademarks or logos, color combinations, structure and design, selection of materials used, computer programs necessary for its operation, access and use, etc.), ownership of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L They will therefore be works protected as intellectual property by the Spanish legal system, being applicable both Spanish and Community regulations in this field, as well as international treaties relating to the subject and signed by Spain. All rights reserved. Pursuant to the provisions of articles 8 and 32.1, second paragraph, of the Law on Intellectual Property, reproduction, distribution and public communication, including its modality of making available, all or part of the Contents of this website, for commercial purposes, in any medium and by any technical means, without the authorization of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. The user undertakes to respect the rights of Intellectual Property and Industrial ownership of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. You can view the elements of the portal and even print them, copy them and store them on your computer's hard disk or on any other physical media provided it is, solely and exclusively, for your personal and private use. The user must refrain from deleting, altering, evading or manipulating any protection device or security system that was installed on the pages of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. LEGAL ACTIONS, APPLICABLE LEGISLATION AND JURISDICTION DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L also reserves the right to file any civil or criminal actions it deems appropriate due to improper use of its website and contents, or for non-compliance with these conditions. The relationship between the user and the provider shall be governed by current legislation and application in Spanish territory. If any dispute arises, the parties may submit their disputes to arbitration or go to the ordinary jurisdiction complying with the rules on jurisdiction and jurisdiction in this regard. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L has its registered office in MADRID, Spain.Conditions of use In compliance with Law 34/2002, of July 11, on Services of the Information Society and Electronic Commerce (LSSI-CE), DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L reports that it owns the website doctaforum.com, doctaforum .net. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L announces the following information: The owner of this website is DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, with CIF B82236464 and registered office in C / MONASTERIO DE YUSO Y SUSO 34 OFI 4 -14-2 28049, MADRID, registered in the Mercantile Register, in tome20532, folio 121, sheet M-363490 and inscription First. The email address of contact with the company is: info@doctaforum.com. USER AND RESPONSIBILITY REGIME The navigation, access and use by the website of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L confers the condition of user, by which, from the navigation through the website of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, all the conditions of use established herein Without prejudice to the application of the corresponding regulations of legal compliance as the case may be. The DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L website provides a wide range of information, services and data. The user assumes his responsibility in the correct use of the website. This responsibility will be extended to: - The veracity and legality of the information provided by the user in the forms extended by DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.Lara the access to certain contents or services offered by the web. - The use of the information, services and data offered by DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L contrary to the provisions of the present conditions, the Law, morality, good customs or public order, or that in any other way may imply damage of the rights Third party or the same operation of the website. POLICY OF LINKS AND EXEMPTIONS OF RESPONSIBILITY DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L is not responsible for the content of the websites to which the user can access through the links established in its website and states that in no case will proceed to examine or exercise any type Control over the content of other sites on the network. Likewise, it will not guarantee the technical availability, accuracy, truthfulness, validity or legality of sites outside of your property that can be accessed through the links. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L declares that it has taken all necessary measures to avoid any damage to the users of its website, which could be derived from browsing its website. Consequently, DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L is not responsible, in any case, for any damages that the user may experience on the Internet. MODIFICATIONS DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L reserves the right to make the modifications that it deems appropriate, without prior notice, in the content of its website. Both in terms of the contents of the website, and in the conditions of use of the same. Such modifications may be made through its website by any form admissible in law and will be enforced during the time they are published on the web and until they are validly modified by later ones. INTERNET RESERVATION SERVICES Certain contents of the DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L website contain the possibility of booking on the Internet. The use of these will require the reading and mandatory acceptance of the general booking conditions established for this purpose by DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. DATA PROTECTION In accordance with the Organic Law 15/1999 on Personal Data Protection (LOPD), DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informs users of its website that the personal data collected by the company, through the forms In their pages, will be entered in an automated file under the responsibility of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, in order to facilitate, expedite and fulfill the commitments established between both parties. Likewise, DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L informs the possibility of exercising the rights of access, rectification, cancellation and opposition by means of a writing to the address: C / MONASTERIO DE YUSO Y SUSO 34 OFI 4-14-2 28049, MADRID. As long as the user does not communicate to DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L, it will understand that their data has not been modified, that the user undertakes to notify DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L of any variation and that DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L has the consent to use them in order to be able to retain The relationship between the parties. INTELLECTUAL AND INDUSTRIAL PROPERTY DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L by itself or as a transferee, is the owner of all intellectual and industrial property rights of its website, as well as of the elements contained in it (by way of example, images, sound, audio, Video, software or texts, trademarks or logos, color combinations, structure and design, selection of materials used, computer programs necessary for its operation, access and use, etc.), ownership of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L They will therefore be works protected as intellectual property by the Spanish legal system, being applicable both Spanish and Community regulations in this field, as well as international treaties relating to the subject and signed by Spain. All rights reserved. Pursuant to the provisions of articles 8 and 32.1, second paragraph, of the Law on Intellectual Property, reproduction, distribution and public communication, including its modality of making available, all or part of the Contents of this website, for commercial purposes, in any medium and by any technical means, without the authorization of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. The user undertakes to respect the rights of Intellectual Property and Industrial ownership of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. You can view the elements of the portal and even print them, copy them and store them on your computer's hard disk or on any other physical media provided it is, solely and exclusively, for your personal and private use. The user must refrain from deleting, altering, evading or manipulating any protection device or security system that was installed on the pages of DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L. LEGAL ACTIONS, APPLICABLE LEGISLATION AND JURISDICTION DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L also reserves the right to file any civil or criminal actions it deems appropriate due to improper use of its website and contents, or for non-compliance with these conditions. The relationship between the user and the provider shall be governed by current legislation and application in Spanish territory. If any dispute arises, the parties may submit their disputes to arbitration or go to the ordinary jurisdiction complying with the rules on jurisdiction and jurisdiction in this regard. DOCTAFORUM CONGRESOS Y REUNIONES CIENTIFICAS S.L has its registered office in MADRID, Spain.";
	endif;
?>
   </div>
      </div>
    </div>
  </div>
</div>
<!-- modal-->

<!-- modal-->
<div class="modal fade" id="modalcookie2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Política de Cookies";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Cookies policy";
	endif;
?></h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="spanclose">×</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
   <div class="row">
<?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Una";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "A";
	endif;
?> <em>cookie</em> <?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "es un pequeño fichero de texto que se almacena en su navegador cuando visita casi cualquier página web. Su utilidad es que la web sea capaz de recordar su visita cuando vuelva a navegar por esa página. Las";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "is a small text file that is stored in your browser when you visit almost any web page. Its usefulness is that the web is able to remember your visit when you return to navigate that page. The";
	endif;
?> <em>cookies</em><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "suelen almacenar información de carácter técnico, preferencias personales, personalización de contenidos, estadísticas de uso, enlaces a redes sociales, acceso a cuentas de usuario, etc. El objetivo de la";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "usually store technical information, personal preferences, content customization, usage statistics, links to social networks, access to user accounts, etc. The objective of the";
	endif;
?>  <em>cookie</em><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo " es adaptar el contenido de la web a su perfil y necesidades, sin ";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo " is to adapt the content of the web to your profile and needs, without";
	endif;
?><em>cookies</em><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo " los servicios ofrecidos por cualquier página se verían mermados notablemente. Si desea consultar más información sobre qué son las ";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo " the services offered by any page would be significantly reduced. If you want to know more about what the";
	endif;
?><em>cookies</em><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo ", qué almacenan, cómo eliminarlas, desactivarlas, etc.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo ", what they store, how to delete them, deactivate them, etc.";
	endif;
?>
<h3><strong><u><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Cookies utilizadas en este sitio web";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Cookies used on this website";
	endif;
?></u></strong></h3>
<?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Siguiendo las directrices de la Agencia Española de Protección de Datos procedemos a detallar el uso de cookies que hace esta web con el fin de informarle con la máxima exactitud posible.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Following the guidelines of the Spanish Agency for Data Protection we proceed to detail the use of cookies made by this website in order to inform you as accurately as possible.";
	endif;
?>

<?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Este sitio web utiliza las siguientes";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "This website uses the following";
	endif;
?> <strong><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "cookies propias";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "own cookies";
	endif;
?></strong>:
<ul>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Cookies de sesión, para garantizar que los usuarios que escriban comentarios en el blog sean humanos y no aplicaciones automatizadas. De esta forma se combate el spam.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Session cookies, to ensure that users who write comments on the blog are human and not automated applications. In this way spam is combated.";
	endif;
?></li>
</ul>
<?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Este sitio web utiliza las siguientes ";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "This website uses the following ";
	endif;
?> <strong><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "cookies de terceros";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "third-party cookies";
	endif;
?></strong>:
<ul>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Google Analytics: Almacena cookies para poder elaborar estadísticas sobre el tráfico y volumen de visitas de esta web. Al utilizar este sitio web está consintiendo el tratamiento de información acerca de usted por Google. Por tanto, el ejercicio de cualquier derecho en este sentido deberá hacerlo comunicando directamente con Google.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Google Analytics: Stores cookies to be able to produce statistics on the traffic and volume of visits of this website. By using this website you are consenting to the processing of information about you by Google. Therefore, the exercise of any right in this regard must do so by communicating directly with Google.";
	endif;
?></li>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Redes sociales: Cada red social utiliza sus propias cookies para que usted pueda pinchar en botones del tipo Me gusta o Compartir.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Social networks: Each social network uses its own cookies so that you can click on Like or Share buttons.";
	endif;
?></li>
</ul>
<h3><strong><u><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Desactivación o eliminación de cookies";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Deactivation or removal of cookies";
	endif;
?></u></strong></h3><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "En cualquier momento podrá ejercer su derecho de desactivación o eliminación de cookies de este sitio web. Estas acciones se realizan de forma diferente en función del navegador que esté usando.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "At any time you may exercise your right to deactivate or delete cookies from this website. These actions are performed differently based on the browser you are using.";
	endif;
?>
 <!-- <a href="http://www.doctaforum.com/2017/02/09/cookie/">Aquí le dejamos una guía rápida para los navegadores más populares.</a> -->
<h3><strong><u>Notas adicionales</u></strong></h3>
<ul>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Ni esta web ni sus representantes legales se hacen responsables ni del contenido ni de la veracidad de las políticas de privacidad que puedan tener los terceros mencionados en esta política de cookies.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "Neither this website nor its legal representatives are responsible for either the content or the veracity of the privacy policies that the third parties mentioned in this cookie policy may have.";
	endif;
?></li>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Los navegadores web son las herramientas encargadas de almacenar las cookies y desde este lugar debe efectuar su derecho a eliminación o desactivación de las mismas. Ni esta web ni sus representantes legales pueden garantizar la correcta o incorrecta manipulación de las cookies por parte de los mencionados navegadores.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "The web browsers are the tools in charge of storing the cookies and from this place you must make your right to delete or deactivate them. Neither this website nor its legal representatives can guarantee the correct or incorrect handling of cookies by the mentioned browsers.";
	endif;
?></li>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "En algunos casos es necesario instalar cookies para que el navegador no olvide su decisión de no aceptación de las mismas.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "In some cases it is necessary to install cookies so that the browser does not forget its decision not to accept them.";
	endif;
?></li>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "En el caso de las cookies de Google Analytics, esta empresa almacena las cookies en servidores ubicados en Estados Unidos y se compromete a no compartirla con terceros, excepto en los casos en los que sea necesario para el funcionamiento del sistema o cuando la ley obligue a tal efecto. Según Google no guarda su dirección IP. Google Inc. es una compañía adherida al Acuerdo de Puerto Seguro que garantiza que todos los datos transferidos serán tratados con un nivel de protección acorde a la normativa europea. Puede consultar información detallada a este respecto ";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "In the case of Google Analytics cookies, this company stores cookies on servers located in the United States and agrees not to share with third parties, except in cases where it is necessary for the operation of the system or when the law requires Such effect. According to Google does not save your IP address. Google Inc. is a company adhering to the Safe Harbor Agreement that guarantees that all data transferred will be treated with a level of protection in accordance with European regulations. You can consult detailed information in this regard ";
	endif;
?><a href="http://safeharbor.export.gov/companyinfo.aspx?id=16626" target="_blank"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "en este enlace";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "in this link";
	endif;
?></a>. <?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Si desea información sobre el uso que Google da a las cookies ";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "For information about how Google uses cookies";
	endif;
?><a href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage?hl=es&amp;csw=1" target="_blank"><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "le adjuntamos este otro enlace";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "we enclose this other link";
	endif;
?></a>.</li>
 	<li><?php 
	if($GLOBALS['q_config']['language']=='es'):
		echo "Para cualquier duda o consulta acerca de esta política de cookies no dude en comunicarse con nosotros a través de la sección de contacto.";
	endif;
	if($GLOBALS['q_config']['language']=='en'):
		echo "For any questions or queries about this cookie policy do not hesitate to contact us through the contact section.";
	endif;
?></li>
</ul>   </div>
      </div>
    </div>
  </div>
</div>
<!-- modal-->
</div>
</div>

<?php zerif_after_footer_trigger(); ?>

	</div><!-- mobile-bg-fix-whole-site -->
</div><!-- .mobile-bg-fix-wrap -->

<?php
/*
 *  Fix for sections with widgets not appearing anymore after the hide button is selected for each section
 * */
if ( is_customize_preview() ) {

	if ( is_active_sidebar( 'sidebar-ourfocus' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-ourfocus' );
		echo '</div>';
	}
	if ( is_active_sidebar( 'sidebar-aboutus' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-aboutus' );
		echo '</div>';
	}
	if ( is_active_sidebar( 'sidebar-ourteam' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-ourteam' );
		echo '</div>';
	}
	if ( is_active_sidebar( 'sidebar-testimonials' ) ) {
		echo '<div class="zerif_hidden_if_not_customizer">';
			dynamic_sidebar( 'sidebar-testimonials' );
		echo '</div>';
	}
}

?>

<?php wp_footer(); ?>

<?php zerif_bottom_body_trigger(); ?>


</body>

</html>