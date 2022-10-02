-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2022 at 10:50 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`id`, `email`, `password`) VALUES
(1, 'charsal13579@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `bill_no` varchar(20) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`id`, `product_name`, `stock`, `bill_no`, `cost_price`, `created_on`) VALUES
(14, 'Samsung S22 ultra', 50, 'AMD_001', 1000, '2022-09-30 17:23:23'),
(15, 'Samsung Fold', 20, 'AMD_001', 1600, '2022-09-30 17:23:23'),
(16, 'Oppo Find N', 25, 'AMD_002', 1700, '2022-09-30 17:23:23'),
(17, 'Oppo F21 pro', 30, 'AMD_002', 700, '2022-09-30 17:23:23'),
(18, 'Xiaomi mi mix fold ', 20, 'AMD_003', 1300, '2022-09-30 17:23:23'),
(19, 'Xiaomi Redmi Note 11', 30, 'AMD_003', 450, '2022-09-30 17:23:23'),
(20, 'Iphone 14', 45, 'AMD_004', 900, '2022-09-30 17:23:23'),
(21, 'Iphone 14 pro', 35, 'AMD_004', 1050, '2022-09-30 17:23:23'),
(22, 'Iphone 14 pro max', 25, 'AMD_004', 1250, '2022-09-30 17:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`, `created_at`) VALUES
(1, 'Flagship phones', 0, '2022-09-28 21:50:43'),
(2, 'Folding Phones', 0, '2022-09-28 21:50:43'),
(3, 'Budget Phones', 0, '2022-09-28 21:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `country_name`
--

CREATE TABLE `country_name` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_name`
--

INSERT INTO `country_name` (`id`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'American Samoa'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antarctica'),
(9, 'Antigua and Barbuda'),
(10, 'Argentina'),
(11, 'Armenia'),
(12, 'Aruba'),
(13, 'Australia'),
(14, 'Austria'),
(15, 'Azerbaijan'),
(16, 'Bahamas'),
(17, 'Bahrain'),
(18, 'Bangladesh'),
(19, 'Barbados'),
(20, 'Belarus'),
(21, 'Belgium'),
(22, 'Belize'),
(23, 'Benin'),
(24, 'Bermuda'),
(25, 'Bhutan'),
(26, 'Bolivia'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo'),
(50, 'Congo, the Democratic Republic of the'),
(51, 'Cook Islands'),
(52, 'Costa Rica'),
(53, 'Cote DIvoire'),
(54, 'Croatia'),
(55, 'Cuba'),
(56, 'Cyprus'),
(57, 'Czech Republic'),
(58, 'Denmark'),
(59, 'Djibouti'),
(60, 'Dominica'),
(61, 'Dominican Republic'),
(62, 'Ecuador'),
(63, 'Egypt'),
(64, 'El Salvador'),
(65, 'Equatorial Guinea'),
(66, 'Eritrea'),
(67, 'Estonia'),
(68, 'Ethiopia'),
(69, 'Falkland Islands (Malvinas)'),
(70, 'Faroe Islands'),
(71, 'Fiji'),
(72, 'Finland'),
(73, 'France'),
(74, 'French Guiana'),
(75, 'French Polynesia'),
(76, 'French Southern Territories'),
(77, 'Gabon'),
(78, 'Gambia'),
(79, 'Georgia'),
(80, 'Germany'),
(81, 'Ghana'),
(82, 'Gibraltar'),
(83, 'Greece'),
(84, 'Greenland'),
(85, 'Grenada'),
(86, 'Guadeloupe'),
(87, 'Guam'),
(88, 'Guatemala'),
(89, 'Guinea'),
(90, 'Guinea-Bissau'),
(91, 'Guyana'),
(92, 'Haiti'),
(93, 'Heard Island and Mcdonald Islands'),
(94, 'Holy See (Vatican City State)'),
(95, 'Honduras'),
(96, 'Hong Kong'),
(97, 'Hungary'),
(98, 'Iceland'),
(99, 'India'),
(100, 'Indonesia'),
(101, 'Iran, Islamic Republic of'),
(102, 'Iraq'),
(103, 'Ireland'),
(104, 'Israel'),
(105, 'Italy'),
(106, 'Jamaica'),
(107, 'Japan'),
(108, 'Jordan'),
(109, 'Kazakhstan'),
(110, 'Kenya'),
(111, 'Kiribati'),
(112, 'Korea, Democratic Peoples Republic of'),
(113, 'Korea, Republic of'),
(114, 'Kuwait'),
(115, 'Kyrgyzstan'),
(116, 'Lao Peoples Democratic Republic'),
(117, 'Latvia'),
(118, 'Lebanon'),
(119, 'Lesotho'),
(120, 'Liberia'),
(121, 'Libyan Arab Jamahiriya'),
(122, 'Liechtenstein'),
(123, 'Lithuania'),
(124, 'Luxembourg'),
(125, 'Macao'),
(126, 'Macedonia, the Former Yugoslav Republic of'),
(127, 'Madagascar'),
(128, 'Malawi'),
(129, 'Malaysia'),
(130, 'Maldives'),
(131, 'Mali'),
(132, 'Malta'),
(133, 'Marshall Islands'),
(134, 'Martinique'),
(135, 'Mauritania'),
(136, 'Mauritius'),
(137, 'Mayotte'),
(138, 'Mexico'),
(139, 'Micronesia, Federated States of'),
(140, 'Moldova, Republic of'),
(141, 'Monaco'),
(142, 'Mongolia'),
(143, 'Montserrat'),
(144, 'Morocco'),
(145, 'Mozambique'),
(146, 'Myanmar'),
(147, 'Namibia'),
(148, 'Nauru'),
(149, 'Nepal'),
(150, 'Netherlands'),
(151, 'Netherlands Antilles'),
(152, 'New Caledonia'),
(153, 'New Zealand'),
(154, 'Nicaragua'),
(155, 'Niger'),
(156, 'Nigeria'),
(157, 'Niue'),
(158, 'Norfolk Island'),
(159, 'Northern Mariana Islands'),
(160, 'Norway'),
(161, 'Oman'),
(162, 'Pakistan'),
(163, 'Palau'),
(164, 'Palestinian Territory, Occupied'),
(165, 'Panama'),
(166, 'Papua New Guinea'),
(167, 'Paraguay'),
(168, 'Peru'),
(169, 'Philippines'),
(170, 'Pitcairn'),
(171, 'Poland'),
(172, 'Portugal'),
(173, 'Puerto Rico'),
(174, 'Qatar'),
(175, 'Reunion'),
(176, 'Romania'),
(177, 'Russian Federation'),
(178, 'Rwanda'),
(179, 'Saint Helena'),
(180, 'Saint Kitts and Nevis'),
(181, 'Saint Lucia'),
(182, 'Saint Pierre and Miquelon'),
(183, 'Saint Vincent and the Grenadines'),
(184, 'Samoa'),
(185, 'San Marino'),
(186, 'Sao Tome and Principe'),
(187, 'Saudi Arabia'),
(188, 'Senegal'),
(189, 'Serbia and Montenegro'),
(190, 'Seychelles'),
(191, 'Sierra Leone'),
(192, 'Singapore'),
(193, 'Slovakia'),
(194, 'Slovenia'),
(195, 'Solomon Islands'),
(196, 'Somalia'),
(197, 'South Africa'),
(198, 'South Georgia and the South Sandwich Islands'),
(199, 'Spain'),
(200, 'Sri Lanka'),
(201, 'Sudan'),
(202, 'Suriname'),
(203, 'Svalbard and Jan Mayen'),
(204, 'Swaziland'),
(205, 'Sweden'),
(206, 'Switzerland'),
(207, 'Syrian Arab Republic'),
(208, 'Taiwan, Province of China'),
(209, 'Tajikistan'),
(210, 'Tanzania, United Republic of'),
(211, 'Thailand'),
(212, 'Timor-Leste'),
(213, 'Togo'),
(214, 'Tokelau'),
(215, 'Tonga'),
(216, 'Trinidad and Tobago'),
(217, 'Tunisia'),
(218, 'Turkey'),
(219, 'Turkmenistan'),
(220, 'Turks and Caicos Islands'),
(221, 'Tuvalu'),
(222, 'Uganda'),
(223, 'Ukraine'),
(224, 'United Arab Emirates'),
(225, 'United Kingdom'),
(226, 'United States'),
(227, 'United States Minor Outlying Islands'),
(228, 'Uruguay'),
(229, 'Uzbekistan'),
(230, 'Vanuatu'),
(231, 'Venezuela'),
(232, 'Viet Nam'),
(233, 'Virgin Islands, British'),
(234, 'Virgin Islands, U.s.'),
(235, 'Wallis and Futuna'),
(236, 'Western Sahara'),
(237, 'Yemen'),
(238, 'Zambia'),
(239, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `coupon_number` varchar(10) NOT NULL,
  `reduce_percentage` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_number`, `reduce_percentage`, `status`, `orders`) VALUES
(1, 'K1iq3fH', 3, 1, 5),
(2, 'UZLPgQC', 5, 1, 10),
(3, 'V4SKEvY', 7, 1, 15),
(4, 'XBH9sv0', 9, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_expenses`
--

CREATE TABLE `monthly_expenses` (
  `id` int(11) NOT NULL,
  `bills` int(11) NOT NULL,
  `miscellaneous_expense` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `transport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_expenses`
--

INSERT INTO `monthly_expenses` (`id`, `bills`, `miscellaneous_expense`, `tax`, `transport`) VALUES
(3, 5, 10, 2, 0),
(4, 10, 0, 0, 0),
(5, 10, 0, 0, 0),
(6, 20, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `order_id`, `status`) VALUES
(12, 13, 1),
(13, 14, 1),
(14, 15, 1),
(15, 16, 1),
(16, 17, 1),
(17, 18, 1),
(18, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `single_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `product_id`, `order_id`, `quantity`, `single_price`, `total_price`, `order_number`, `status`, `user_id`, `created_on`) VALUES
(1, 2, 2, 1, 1695, 1695, 9726, 1, 1, '2022-09-29 16:07:28'),
(2, 1, 3, 1, 1120, 1120, 9082, 2, 1, '2022-09-29 16:07:28'),
(3, 7, 4, 1, 1440, 1440, 3594, 1, 1, '2022-09-29 16:07:28'),
(4, 6, 5, 1, 510, 510, 5988, 1, 1, '2022-09-29 16:07:28'),
(11, 8, 12, 1, 767, 767, 5188, 2, 1, '2022-09-29 16:07:28'),
(15, 6, 16, 1, 805, 781, 8722, 0, 1, '2022-09-30 17:19:40'),
(16, 5, 19, 2, 2040, 4080, 4671, 0, 1, '2022-10-01 17:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `country_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `order_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `first_name`, `last_name`, `phone_number`, `email`, `country_id`, `address`, `postal_code`, `city`, `order_number`, `user_id`, `date`) VALUES
(2, 'Muhammad', 'Arsal', '03054388608', 'm.adeelnawaz147@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 9726, 1, '2022-09-29 15:46:50'),
(3, 'Muhammad', 'Arsal', '03054388608', 'charsal13579@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 9082, 1, '2022-09-29 15:49:13'),
(4, 'Muhammad', 'Arsal', '03054388608', 'm.adeelnawaz147@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 3594, 1, '2022-09-29 15:49:35'),
(5, 'Muhammad', 'Arsal', '03054388608', 'm.adeelnawaz147@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 5988, 1, '2022-09-29 15:50:15'),
(12, 'Muhammad', 'Arsal', '03054388608', 'ali12@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 5188, 1, '2022-09-29 16:02:42'),
(16, 'Muhammad', 'Arsal', '03054388608', 'ali12@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 8722, 1, '2022-09-30 17:19:40'),
(17, 'Muhammad', 'Arsal', '03054388608', 'charsal13579@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 7998, 1, '2022-10-01 17:40:44'),
(18, 'Muhammad', 'Arsal', '03054388608', 'ali12@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 2115, 1, '2022-10-01 17:42:10'),
(19, 'Muhammad', 'Arsal', '03054388608', 'm.adeelnawaz147@gmail.com', 162, 'House no 4,Street no. 1, Awan colony near commissioner house', '10400', 'Sargodha', 4671, 1, '2022-10-01 17:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_details` text NOT NULL,
  `arrived_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  `seller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_image`, `product_description`, `product_details`, `arrived_at`, `category_id`, `seller`) VALUES
(1, 'Samsung S22 ultra', '1664441536.jpg', 'A magical new way to interact with Samung.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:52:16', 1, 1),
(2, 'Samsung Fold', '1664441644.jpg', 'A magical new way to interact with Samung.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:53:15', 2, 1),
(3, 'Iphone 14', '1664441679.jpg', 'A magical new way to interact with iPhone.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:54:39', 1, 4),
(4, 'Iphone 14 pro', '1664441711.jfif', 'A magical new way to interact with iPhone.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:55:11', 1, 4),
(5, 'Oppo Find N', '1664441750.png', 'A magical new way to interact with Oppo.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:55:50', 2, 2),
(6, 'Oppo F21 pro', '1664441797.jpg', 'A magical new way to interact with Oppo.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:56:37', 3, 2),
(7, 'Xiaomi mi mix fold ', '1664441924.jpg', 'A magical new way to interact with Xiaomi.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 13:58:44', 2, 3),
(8, 'Xiaomi Redmi Note 11', '1664442003.jpg', 'A magical new way to interact with Xiaomi.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 14:00:03', 3, 3),
(9, 'Iphone 14 pro max', '1664442194.jpg', 'A magical new way to interact with iPhone.', 'Donec at nibh mi. Nullam vestibulum cursus sem fringilla hendrerit. Curabitur egestas scelerisque tristique. Morbi accumsan, turpis sed feugiat rhoncus, elit quam pulvinar diam, non malesuada arcu mauris at ligula. Praesent in nisi diam. Suspendisse ipsum nibh, ullamcorper eget vestibulum non, molestie id diam. Sed accumsan posuere nibh, id lobortis sem pharetra vel. In scelerisque nec ante ac dictum. Integer rutrum felis quis dui euismod iaculis. Quisque vel mauris non arcu euismod efficitur. Phasellus pretium massa in felis imperdiet commodo. In nulla tellus, aliquam et faucibus sed, faucibus at turpis. Maecenas consequat et ante ut laoreet. Donec bibendum nibh id ultricies dignissim. Nam ipsum diam, bibendum in nisi vitae, aliquet commodo lectus. Curabitur sed mi sem.\r\n\r\nQuisque auctor eros auctor, sagittis arcu ut, sagittis eros. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris eget vulputate elit. Proin vitae fermentum nisi, ut porttitor enim. Vivamus finibus accumsan sollicitudin. Nunc sit amet accumsan quam. Duis ac sollicitudin arcu, nec tristique nisi. Vestibulum viverra metus at tincidunt luctus. Donec congue, libero id placerat condimentum, odio augue mattis augue, nec ultrices massa erat non lorem. Etiam vehicula dignissim venenatis. Ut sapien nisl, imperdiet sit amet dapibus sed, pulvinar vel orci.', '2022-09-29 14:02:25', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `seller_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `seller_name`) VALUES
(1, 'Samsung'),
(2, 'Oppo'),
(3, 'Xiaomi'),
(4, 'IPhone');

-- --------------------------------------------------------

--
-- Table structure for table `seller_products`
--

CREATE TABLE `seller_products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `cost_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller_products`
--

INSERT INTO `seller_products` (`id`, `seller_id`, `product_id`, `stock`, `sale_price`, `cost_price`) VALUES
(13, 1, 1, 48, 1150, 1000),
(14, 1, 2, 20, 1808, 1600),
(15, 2, 5, 21, 2040, 1700),
(16, 2, 6, 27, 805, 700),
(17, 3, 7, 20, 1456, 1300),
(18, 3, 8, 30, 504, 450),
(19, 4, 3, 44, 1017, 900),
(20, 4, 4, 35, 1208, 1050),
(21, 4, 9, 25, 1463, 1250);

-- --------------------------------------------------------

--
-- Table structure for table `user_coupon`
--

CREATE TABLE `user_coupon` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email_num` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `name`, `email_num`, `password`) VALUES
(1, 'Muhammad Arsal', 'charsal13579@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_name`
--
ALTER TABLE `country_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_expenses`
--
ALTER TABLE `monthly_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_products`
--
ALTER TABLE `seller_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_coupon`
--
ALTER TABLE `user_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country_name`
--
ALTER TABLE `country_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `monthly_expenses`
--
ALTER TABLE `monthly_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_products`
--
ALTER TABLE `seller_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_coupon`
--
ALTER TABLE `user_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
