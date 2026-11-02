<?php
/**
 * Site content used by the theme.
 * RULE: all wording below is copied word for word from the original hhphysio.com
 * (reference copy: original-site/pages/home.md and original-site/site-wide.md).
 * Any deviation must be logged in REDESIGN-DIARY.md.
 * ponytail: plain PHP arrays; move to Customizer/ACF fields if non-developers need to edit them.
 */

const HH_PHONE         = '8884447808';
const HH_PHONE_DISPLAY = '888-444-7808';              // header style on original site
const HH_PHONE_FOOTER  = '+ (91) 888 - 444 -7808';    // footer style on original site
const HH_EMAIL         = 'HealingHandsBLR@gmail.com';
const HH_WHATSAPP      = '918884447808';              // Click to Chat plugin setting
const HH_BOOK_URL      = '/book-appointment/';        // original "Book Now" target
const HH_YOUTUBE_ID    = 'l7ARrWEA1jM';               // "Expert Physiotherapists" video
const HH_LOGO          = '/wp-content/uploads/2021/01/logo-straight-min-e1626264330426.png'; // original logo, 360x90
const HH_LOGO_ALT      = 'Healing Hands Advanced Physiotherapy Clinic';
const HH_ABOUT_SHORT   = 'Healing Hands Advanced Physiotherapy Clinic is one of the best physiotherapy clinic in Bangalore. We provide World–class Physical Therapy services at an affordable cost to make the world healthy and pain free.';

/** Footer "Follow Us" icons, same order as the original footer. */
function hh_social() {
	return [
		'Facebook'  => 'https://www.facebook.com/HealinghandsBLR',
		'Instagram' => 'https://www.instagram.com/healing_hands_blr/',
		'X/Twitter' => 'https://twitter.com/HealingHandsBLR',
		'LinkedIn'  => 'https://www.linkedin.com/company/14509531/',
		'YouTube'   => 'https://www.youtube.com/channel/UCh7vzJNKB0SoPXJFN6RTOmw',
	];
}

/**
 * "We Provide Top Quality Physiotherapy Treatment" (original homepage): the 3 original paragraphs, shown as a scroll story.
 * 'title' is a phrase quoted from the paragraph itself (no new wording); photos are original uploads with their original alt text.
 */
function hh_about() {
	$u = '/wp-content/uploads/2021/07/';
	return [
		[
			'title' => 'World–class Physiotherapy services at an affordable cost',
			'text'  => 'Healing Hands Advanced Physiotherapy Clinic was founded by Dr. Vinayak Jyoti with a vision to provide World–class Physiotherapy services at an affordable cost. We are committed to provide excellent physio care by using the most advanced technologies in our ultra-modern clinics, coupled with highly skilled and experienced physiotherapists.',
			'img'   => $u . 'BTM-Layout-interior-1-Healing-Hands-Advanced-Physiotherapy-Clinic.webp',
			'alt'   => 'Healing Hands Advanced Physiotherapy Clinic - BTM Layout Branch',
		],
		[
			'title' => 'The treatment plan as per the patient needs',
			'text'  => 'Our team of best physiotherapists in Bangalore uses the most advanced and updated healing technologies to cure your pain, quickly and effectively. Our Therapists provide the treatment plan as per the patient needs and provide highest level of care.',
			'img'   => $u . 'Manual-Therapy-Healing-Hands-Advanced-Physiotherapy-Clinic-2.webp',
			'alt'   => 'Manual Therapy - Healing Hands Adv',
		],
		[
			'title' => 'Treat the entire root cause of your problem',
			'text'  => 'We completely assess and treat the entire root cause of your problem. This includes, but is not limited to, your work and home stressors, overall body condition, nourishment, hereditary and postural habits and patterns that are held in your muscles.',
			'img'   => $u . 'Therapeutic-Exercise-Healing-Hands-Advanced-Physiotherapy-Clinic.webp',
			'alt'   => 'Therapeutic Exercise - Healing Hands Advanced Physiotherapy Clinic',
		],
	];
}

/** "Services" (original homepage, same order, text, images and links). */
function hh_services() {
	return [
		[ 'title' => 'Orthopedic Physiotherapy', 'text' => 'Physiotherapy concerned with the treatment of injuries or disorders of the skeletal system and associated muscles, joints and ligaments.', 'url' => '/services/orthopedic-physiotherapy-bangalore/', 'img' => '/wp-content/uploads/2021/06/Musculoskeletal-Orthopaedic-Physiotherapy.webp', 'alt' => 'Musculoskeletal/ Orthopaedic Physiotherapy', 'icon' => 'airline_seat_legroom_reduced' ],
		[ 'title' => 'Neurological Physiotherapy', 'text' => 'Physiotherapy concerned with the treatment of patients with neurological conditions such as stroke, spinal cord injury, traumatic brain injury and Parkinson\'s disease.', 'url' => '/services/neurological-physiotherapy/', 'img' => '/wp-content/uploads/2023/02/Neurological-Physiotherapy.webp', 'alt' => 'Neurological Physiotherapy session by physiotherapist', 'icon' => 'psychology' ],
		[ 'title' => 'Physiotherapy At Home', 'text' => 'We specializes in providing home physiotherapy that helps you regain your strength, mobility & recover in the comfort & convenience of your own home.', 'url' => '/services/physiotherapy-at-home/', 'img' => '/wp-content/uploads/2021/06/Physiotherapy-at-home-Best-physiotherapy-clinic.webp', 'alt' => 'Physiotherapy at Home - Healing Hands Physiotherapy', 'icon' => 'home_health' ],
		[ 'title' => 'Sports Physiotherapy', 'text' => 'Physiotherapy that focuses on the prevention, treatment, and rehabilitation of injuries related to sports and exercise.', 'url' => '/services/sports-physiotherapy/', 'img' => '/wp-content/uploads/2021/06/Healing-Hands-Sports-Physiotherapy-best-physiotherapy-clinic-in-bangalore-e1622532660248.webp', 'alt' => 'Sports Physiotherapy by Healing Hands', 'icon' => 'sports_tennis' ],
		[ 'title' => 'Applied Physiology', 'text' => 'Applied Physiology is a holistic approach that integrates ancient healing arts with modern scientific methods.', 'url' => '/services/applied-physiology/', 'img' => '/wp-content/uploads/2024/09/Applied-Physiology.jpg', 'alt' => 'Applied Physiology', 'icon' => 'spa' ],
		// Original text kept as-is (it describes Pediatric Physiotherapy). Flagged in REDESIGN-DIARY.md.
		[ 'title' => 'Chiropractor Treatment', 'text' => 'Pediatric Physiotherapy is a specialized branch of physical therapy that focuses on the unique needs of infants and children.', 'url' => '/services/chiropractor-treatment/', 'img' => '/wp-content/uploads/2024/02/Chiropractor-Treatment.jpg', 'alt' => 'Young Chiropractor doing some Chiropractic Adjustments on a patient', 'icon' => 'accessibility_new' ],
	];
}

/** "Therapies" (original homepage). */
function hh_therapies() {
	return [
		'intro' => [
			'We provide wide range of Therapies and Treatments. You will be under good hands because all physiotherapists of our clinic are highly trained, experienced and certified. We make sure that you will receive the world-class physiotherapy treatment in Bangalore.',
			'Our Physiotherapists empower our client by providing them the best solution and by educating the client about their present conditions and how the particular therapy is going to help them in achieving the goal. We set the goals based on our client\'s needs and their overall condition.',
		],
		'items' => [
			[ 'Electrotherapy Modalities', '/wp-content/uploads/2021/07/Electrotherapy-Modalities-1.webp', 'Electrotherapy Modalities - Healing Hands Advanced Physiotherapy Clinic' ],
			[ 'Dry Needling', '/wp-content/uploads/2021/07/Dry-Needling-Healing-Hands-Advanced-Physiotherapy-Clinic-1.webp', 'Dry Needling - Healing Hands Advanced Physiotherapy Clinic' ],
			[ 'Cupping Therapy', '/wp-content/uploads/2021/07/Cupping-Therapy-Healing-Hands-Advanced-Physiotherapy-Clinic.webp', 'Cupping Therapy - Healing Hands Advanced Physiotherapy Clinic' ],
			[ 'Manual Therapy', '/wp-content/uploads/2021/07/Manual-Therapy-Healing-Hands-Advanced-Physiotherapy-Clinic-2.webp', 'Manual Therapy - Healing Hands Adv' ],
			[ 'Therapeutic Exercise', '/wp-content/uploads/2021/07/Therapeutic-Exercise-Healing-Hands-Advanced-Physiotherapy-Clinic.webp', 'Therapeutic Exercise - Healing Hands Advanced Physiotherapy Clinic' ],
			[ 'Kinesio Taping', '/wp-content/uploads/2021/07/Kinesio-Taping-Healing-Hands-Advanced-Physiotherapy-Clinic-2.webp', 'Kinesio Taping- Healing Hands Advanced Physiotherapy Clinic' ],
		],
	];
}

/** "Treatment by Symptoms" (original homepage). x/y = hotspot on the body diagram (viewBox 320×460). */
function hh_symptoms() {
	return [
		'back'   => [ 'label' => 'Back Pain', 'icon' => 'airline_seat_recline_extra', 'text' => 'Determining the cause behind back pain is not enough, as you need to focus on multiple treatments and therapies to produce better results.', 'url' => '/symptoms/back-pain/', 'x' => 160, 'y' => 205 ],
		'neck'   => [ 'label' => 'Neck Pain', 'icon' => 'accessibility_new', 'text' => 'The neck is made out of vertebrates that start from skull to upper torso. Cervical discs will absorb shocks between bones.', 'url' => '/symptoms/neck-pain/', 'x' => 160, 'y' => 80 ],
		'knee'   => [ 'label' => 'Knee Pain', 'icon' => 'directions_walk', 'text' => 'The knee joint is one of the largest joints of the human body. It will help you to walk, run or dance. Damage to any structure in the knee joint can impact normal movement.', 'url' => '/symptoms/knee-pain/', 'x' => 186, 'y' => 345 ],
		'muscle' => [ 'label' => 'Muscle Stiffness', 'icon' => 'self_improvement', 'text' => 'Muscle stiffness, also known as stiffness or tightness in the muscles. During muscle stiffness you will find it more difficult to move than you generally do after rest. In short stiff muscle impairs movement and flexibility.', 'url' => '/symptoms/muscle-stiffness/', 'x' => 104, 'y' => 150 ],
	];
}

/** "Why Us" (original homepage). */
function hh_why_us() {
	return [
		[ 'workspace_premium', 'Expert Physiotherapists', 'Our physiotherapists are highly trained & certified' ],
		[ 'bolt', 'Faster Recovery', 'Faster and long lasting recovery with Healing Hands' ],
		[ 'search_check', 'Accurate Diagnosis', 'Detailed assessment and accurate diagnosis' ],
		[ 'event_available', 'Hassle Free Appointments', 'Just select the date, time and fill up the form or simply call us' ],
		[ 'science', 'Evidence Based Treatment', 'Evidence based advanced treatment is done.' ],
		[ 'clean_hands', 'Hygienic Environment', 'We maintain safe and hygienic environment' ],
	];
}

/** "Our Team" (original homepage, same order, names, roles, photos and alt text). */
function hh_doctors() {
	$u = '/wp-content/uploads/';
	return [
		[ 'Dr Vinayak Jyoti', '', $u . '2026/10/Dr-Vinayak-Jyoti-Director-of-Healing-Hands-Advanced-Physiotherapy-Clinic.jpg', 'Dr Vinayak Jyoti - Director of Healing Hands Advanced Physiotherapy Clinic' ],
		[ 'Dr Iba K.', 'Chief Physiotherapist & Operations Manager', $u . '2025/08/WhatsAppImage2025-08-15at8.46.30AM-ezgif.com-resize.jpg', 'Dr Iba - Chief Physiotherapist & Operations Manager' ],
		[ 'Dr Sreelakshmi Subash', 'Consultant Physiotherapist - JP Nagar Branch', $u . '2025/08/Dr-Sreelakshmi-Subash.jpg', 'Dr Sreelakshmi Subash - Consultant Physiotherapist JP Nagar Branch' ],
		[ 'Dr Divya Chandraprakash', 'Consultant Physiotherapist JP Nagar Branch', $u . '2025/11/DrDivyaChandraprakash-ezgif.com-resize.jpg', '' ],
		[ 'Dr Anindya Deb', 'Consultant Physiotherapist - BTM Branch', $u . '2025/03/Anindya-Deb-Consultant-Physiotherapist-JP-Nagar.webp', 'Dr Anindya Deb - Consultant Physiotherapist BTM Branch' ],
		[ 'Dr Mitali Baruah', 'Consultant Physiotherapist - Jayanagar Branch', $u . '2026/05/Dr-Mitali-Baruah.webp', 'Dr Mitali Baruah - Consultant Physiotherapist - Jayanagar Branch' ],
		[ 'Dr Samhitha P S', 'Consultant Physiotherapist - Jayanagar Branch', $u . '2025/08/Dr-Samitha-P-S.webp', 'Dr Samitha P S - Consultant Physiotherapist Jayanagar' ],
		[ 'Dr. KARTHIK VASAN', 'Consultant Physiotherapist - Jayanagar Branch', $u . '2026/05/Dr.-KARTHIK-VASAN.webp', '' ],
		[ 'Dr. Jane Caryn Lobo', 'Consultant Physiotherapist - BTM Branch', $u . '2026/05/Dr.-Jane-Caryn-Lobo.webp', 'Dr. Jane Caryn Lobo - Consultant Physiotherapist - BTM Branch' ],
		[ 'Dr Paul Vimalraj', 'Home Care Physiotherapist - Bangalore', $u . '2025/03/Dr-Paul-Vimalraj-Homecare-Physio.webp', 'Dr Paul Vimalraj, Home Care Physiotherapist - Healing Hands Home Care, Bangalore' ],
		[ 'Dr Baijnath Agrawal', 'Consultant Physician (Ayur). Ex Medical Officer RKMTBS, Ranchi', $u . '2021/11/Dr-Baijnath-Agrawal.webp', 'Dr Baijnath Agrawal - Consultant Physician (Ayur)' ],
	];
}

/**
 * "Physiotherapy in Bangalore" (original homepage: name, photo, link).
 * Addresses come from the original branch contact pages (original-site/pages/contact-us__*.md).
 */
function hh_branches() {
	return [
		'btm'       => [ 'name' => 'BTM Layout', 'icon' => 'apartment', 'page' => '/bangalore/best-physiotherapy-clinic-in-btm-layout-bangalore/', 'img' => '/wp-content/uploads/2021/07/BTM-Layout-Interior-Healing-Hands-Advanced-Physiotherapy-Clinic.webp', 'alt' => 'Healing Hands Advanced Physiotherapy Clinic - BTM Layout, Bangalore', 'address' => [ 'No. 22, 7th cross, 1st B Main Rd,', 'near canara bank colony,', 'BTM 2nd Stage, Bengaluru,', 'Karnataka 560076' ] ],
		'jayanagar' => [ 'name' => 'Jayanagar', 'icon' => 'location_city', 'page' => '/bangalore/best-physiotherapy-clinic-in-jayanagar-bangalore/', 'img' => '/wp-content/uploads/2021/07/Jayanagar-Branch-Healing-Hands-Advanced-Physiotherapy-Clinic.webp', 'alt' => 'Healing Hands Advanced Physiotherapy Clinic - Jayanagar Branch, Bangalore', 'address' => [ '#54, 7th B Main Rd,', 'Opp. Ganesha Temple,', 'near cauvery emporium,', '4th Block, Jayanagar,', 'Bengaluru, Karnataka 560011' ] ],
		'jpnagar'   => [ 'name' => 'JP Nagar', 'icon' => 'nature_people', 'page' => '/bangalore/best-physiotherapy-clinic-in-jp-nagar-bangalore/', 'img' => '/wp-content/uploads/2022/08/JP-Nagar-New.jpg', 'alt' => 'Exercise area of a Physiotherapy clinic', 'address' => [ '64/2, Sarakki Main Rd,', 'Sarakki Nagar, 1st Phase,', 'J. P. Nagar, Bengaluru,', 'Karnataka 560078' ] ],
	];
}

/** "Client Testimonials": the original shows three testimonial graphics; their wording (from the image alt text) is reproduced here. */
function hh_testimonials() {
	return [
		[ 'name' => 'Sheub Adnan', 'quote' => 'One of the Best Physiotherapy Clinic in Bangalore. My dad has osteoarthritis, he wasn’t able to walk properly or stand, within 20 days of physiotherapy at healing hands the pain was reduced to almost 60-70%.', 'img' => '/wp-content/uploads/2024/02/Sheub-Testimonial.png' ],
		[ 'name' => 'Jyoti', 'quote' => 'I was suffering from severe back pain but after visiting Healing Hands Advanced Physiotherapy Clinic in Bangalore, l am totally alright. All the doctors are so friendly and helpful. Excellent treatment.', 'img' => '/wp-content/uploads/2024/02/Jyoti-Testimonial.png' ],
		[ 'name' => 'Latha', 'quote' => 'Best physiotherapy in Bangalore.. My son who is suffering from muscular dystrophy has been getting treated at healing hands. I must say that we have chosen the best place for our son. I recommend this clinic to everyone', 'img' => '/wp-content/uploads/2024/02/Latha-Testimonial.png' ],
	];
}

/** Footer columns (original footer). */
function hh_footer_links() {
	return [
		'Find Us'      => [
			'Physiotherapy near me'                          => '/physiotherapy-near-me/',
			'Physiotherapist near me'                        => '/physiotherapist-near-me/',
			'Physiotherapy clinic near me'                   => '/physiotherapy-clinic-near-me/',
			'Non Surgical Knee Pain Treatment in Bangalore'  => 'https://thejointpro.com/',
		],
		'Our Branches' => [
			'JP Nagar, Bangalore'   => '/physiotherapy-clinic-in-bangalore/physiotherapy-clinic-in-jp-nagar-bangalore/',
			'Jayanagar, Bangalore'  => '/physiotherapy-clinic-in-bangalore/physiotherapy-clinic-in-jayanagar-bangalore/',
			'BTM Layout, Bangalore' => '/physiotherapy-clinic-in-bangalore/physiotherapy-clinic-in-btm-layout-bangalore/',
		],
	];
}
