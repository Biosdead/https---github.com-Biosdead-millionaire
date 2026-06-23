-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/06/2026 às 18:00
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `millionaire`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `nameEnglish` varchar(20) NOT NULL,
  `namePortuguese` varchar(20) NOT NULL,
  `acronym` varchar(3) NOT NULL,
  `dollarValue` float NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `currencies`
--

INSERT INTO `currencies` (`id`, `nameEnglish`, `namePortuguese`, `acronym`, `dollarValue`, `date`, `time`) VALUES
(1, 'United Arab Emirates', 'Dirham dos Emirados ', 'AED', 3.6725, '2026-06-23', '00:00:00'),
(2, 'Afghan Afghani', 'Afegane afegão', 'AFN', 63.25, '2026-06-23', '00:00:00'),
(3, 'Albanian Lek', 'Lek albanês', 'ALL', 82.633, '2026-06-23', '00:00:00'),
(4, 'Armenian Dram', 'Dram armênio', 'AMD', 368.08, '2026-06-23', '00:00:00'),
(5, 'Netherlands Antillea', 'Florim das Antilhas ', 'ANG', 1.79, '2026-06-23', '00:00:00'),
(6, 'Angolan Kwanza', 'Kwanza angolano', 'AOA', 912.6, '2026-06-23', '00:00:00'),
(7, 'Argentine Peso', 'Peso argentino', 'ARS', 1461.5, '2026-06-23', '00:00:00'),
(8, 'Australian Dollar', 'Dólar australiano', 'AUD', 1.44159, '2026-06-23', '00:00:00'),
(9, 'Aruban Florin', 'Florim arubano', 'AWG', 1.8, '2026-06-23', '00:00:00'),
(10, 'Azerbaijani Manat', 'Manat azerbaijano', 'AZN', 1.7, '2026-06-23', '00:00:00'),
(11, 'Bosnia and Herzegovi', 'Marco conversível da', 'BAM', 1.71564, '2026-06-23', '00:00:00'),
(12, 'Barbados Dollar', 'Dólar de Barbados', 'BBD', 2, '2026-06-23', '00:00:00'),
(13, 'Bangladeshi Taka', 'Taka de Bangladesh', 'BDT', 122.862, '2026-06-23', '00:00:00'),
(14, 'Bulgarian Lev', 'Lev búlgaro', 'BGN', 1.71732, '2026-06-23', '00:00:00'),
(15, 'Bahraini Dinar', 'Dinar bareinita', 'BHD', 0.3772, '2026-06-23', '00:00:00'),
(16, 'Burundian Franc', 'Franco burundiano', 'BIF', 2988.44, '2026-06-23', '00:00:00'),
(17, 'Bermudian Dollar', 'Dólar bermudense', 'BMD', 1, '2026-06-23', '00:00:00'),
(18, 'Brunei Dollar', 'Dólar de Brunei', 'BND', 1.29555, '2026-06-23', '00:00:00'),
(19, 'Bolivian Boliviano', 'Boliviano', 'BOB', 6.92556, '2026-06-23', '00:00:00'),
(20, 'Brazilian Real', 'Real brasileiro', 'BRL', 5.1853, '2026-06-23', '00:00:00'),
(21, 'Bahamian Dollar', 'Dólar bahamense', 'BSD', 1, '2026-06-23', '00:00:00'),
(22, 'Bitcoin', 'Bitcoin', 'BTC', 0.0000160816, '2026-06-23', '00:00:00'),
(23, 'Bhutanese Ngultrum', 'Ngultrum butanês', 'BTN', 94.6876, '2026-06-23', '00:00:00'),
(24, 'Botswana Pula', 'Pula de Botsuana', 'BWP', 13.6026, '2026-06-23', '00:00:00'),
(25, 'Belarusian Ruble', 'Rublo bielorrusso', 'BYN', 2.80882, '2026-06-23', '00:00:00'),
(26, 'Belize Dollar', 'Dólar belizenho', 'BZD', 2.01133, '2026-06-23', '00:00:00'),
(27, 'Canadian Dollar', 'Dólar canadense', 'CAD', 1.41874, '2026-06-23', '00:00:00'),
(28, 'Congolese Franc', 'Franco congolês', 'CDF', 2299.43, '2026-06-23', '00:00:00'),
(29, 'Swiss Franc', 'Franco suíço', 'CHF', 0.809269, '2026-06-23', '00:00:00'),
(30, 'Chilean Unit of Acco', 'Unidade de Fomento c', 'CLF', 0.023179, '2026-06-23', '00:00:00'),
(31, 'Chilean Peso', 'Peso chileno', 'CLP', 912.21, '2026-06-23', '00:00:00'),
(32, 'Offshore Chinese Yua', 'Yuan chinês offshore', 'CNH', 6.79159, '2026-06-23', '00:00:00'),
(33, 'Chinese Yuan', 'Yuan chinês', 'CNY', 6.7838, '2026-06-23', '00:00:00'),
(34, 'Colombian Peso', 'Peso colombiano', 'COP', 3436.78, '2026-06-23', '00:00:00'),
(35, 'Costa Rican Colón', 'Colón costarriquenho', 'CRC', 453.692, '2026-06-23', '00:00:00'),
(36, 'Cuban Convertible Pe', 'Peso cubano conversí', 'CUC', 1, '2026-06-23', '00:00:00'),
(37, 'Cuban Peso', 'Peso cubano', 'CUP', 25.75, '2026-06-23', '00:00:00'),
(38, 'Cape Verdean Escudo', 'Escudo cabo-verdiano', 'CVE', 96.7254, '2026-06-23', '00:00:00'),
(39, 'Czech Koruna', 'Coroa tcheca', 'CZK', 21.2542, '2026-06-23', '00:00:00'),
(40, 'Djiboutian Franc', 'Franco djibutiano', 'DJF', 178.091, '2026-06-23', '00:00:00'),
(41, 'Danish Krone', 'Coroa dinamarquesa', 'DKK', 6.56324, '2026-06-23', '00:00:00'),
(42, 'Dominican Peso', 'Peso dominicano', 'DOP', 58.5361, '2026-06-23', '00:00:00'),
(43, 'Algerian Dinar', 'Dinar argelino', 'DZD', 133.603, '2026-06-23', '00:00:00'),
(44, 'Egyptian Pound', 'Libra egípcia', 'EGP', 49.7165, '2026-06-23', '00:00:00'),
(45, 'Eritrean Nakfa', 'Nakfa eritreu', 'ERN', 15, '2026-06-23', '00:00:00'),
(46, 'Ethiopian Birr', 'Birr etíope', 'ETB', 161.234, '2026-06-23', '00:00:00'),
(47, 'Euro', 'Euro', 'EUR', 0.87803, '2026-06-23', '00:00:00'),
(48, 'Fijian Dollar', 'Dólar fijiano', 'FJD', 2.24285, '2026-06-23', '00:00:00'),
(49, 'Falkland Islands Pou', 'Libra das Ilhas Malv', 'FKP', 0.756883, '2026-06-23', '00:00:00'),
(50, 'Pound Sterling', 'Libra esterlina', 'GBP', 0.756883, '2026-06-23', '00:00:00'),
(51, 'Georgian Lari', 'Lari georgiano', 'GEL', 2.645, '2026-06-23', '00:00:00'),
(52, 'Guernsey Pound', 'Libra de Guernsey', 'GGP', 0.756883, '2026-06-23', '00:00:00'),
(53, 'Ghanaian Cedi', 'Cedi ganês', 'GHS', 11.2256, '2026-06-23', '00:00:00'),
(54, 'Gibraltar Pound', 'Libra de Gibraltar', 'GIP', 0.756883, '2026-06-23', '00:00:00'),
(55, 'Gambian Dalasi', 'Dalasi gambiano', 'GMD', 73, '2026-06-23', '00:00:00'),
(56, 'Guinean Franc', 'Franco guineense', 'GNF', 8763.37, '2026-06-23', '00:00:00'),
(57, 'Guatemalan Quetzal', 'Quetzal guatemalteco', 'GTQ', 7.62986, '2026-06-23', '00:00:00'),
(58, 'Guyanese Dollar', 'Dólar guianense', 'GYD', 209.232, '2026-06-23', '00:00:00'),
(59, 'Hong Kong Dollar', 'Dólar de Hong Kong', 'HKD', 7.84019, '2026-06-23', '00:00:00'),
(60, 'Honduran Lempira', 'Lempira hondurenha', 'HNL', 26.7571, '2026-06-23', '00:00:00'),
(61, 'Croatian Kuna', 'Kuna croata', 'HRK', 6.61569, '2026-06-23', '00:00:00'),
(62, 'Haitian Gourde', 'Gourde haitiano', 'HTG', 130.757, '2026-06-23', '00:00:00'),
(63, 'Hungarian Forint', 'Forint húngaro', 'HUF', 311.302, '2026-06-23', '00:00:00'),
(64, 'Indonesian Rupiah', 'Rupia indonésia', 'IDR', 17921.6, '2026-06-23', '00:00:00'),
(65, 'Israeli New Shekel', 'Novo shekel israelen', 'ILS', 2.99591, '2026-06-23', '00:00:00'),
(66, 'Isle of Man Pound', 'Libra da Ilha de Man', 'IMP', 0.756883, '2026-06-23', '00:00:00'),
(67, 'Indian Rupee', 'Rúpia indiana', 'INR', 94.731, '2026-06-23', '00:00:00'),
(68, 'Iraqi Dinar', 'Dinar iraquiano', 'IQD', 1310.11, '2026-06-23', '00:00:00'),
(69, 'Iranian Rial', 'Rial iraniano', 'IRR', 1375000, '2026-06-23', '00:00:00'),
(70, 'Icelandic Króna', 'Coroa islandesa', 'ISK', 126.44, '2026-06-23', '00:00:00'),
(71, 'Jersey Pound', 'Libra de Jersey', 'JEP', 0.756883, '2026-06-23', '00:00:00'),
(72, 'Jamaican Dollar', 'Dólar jamaicano', 'JMD', 157.424, '2026-06-23', '00:00:00'),
(73, 'Jordanian Dinar', 'Dinar jordaniano', 'JOD', 0.709, '2026-06-23', '00:00:00'),
(74, 'Japanese Yen', 'Iene japonês', 'JPY', 161.559, '2026-06-23', '00:00:00'),
(75, 'Kenyan Shilling', 'Xelim queniano', 'KES', 129.5, '2026-06-23', '00:00:00'),
(76, 'Kyrgyzstani Som', 'Som quirguiz', 'KGS', 87.45, '2026-06-23', '00:00:00'),
(77, 'Cambodian Riel', 'Riel cambojano', 'KHR', 4014.11, '2026-06-23', '00:00:00'),
(78, 'Comorian Franc', 'Franco comorense', 'KMF', 431, '2026-06-23', '00:00:00'),
(79, 'North Korean Won', 'Won norte-coreano', 'KPW', 900, '2026-06-23', '00:00:00'),
(80, 'South Korean Won', 'Won sul-coreano', 'KRW', 1536.15, '2026-06-23', '00:00:00'),
(81, 'Kuwaiti Dinar', 'Dinar kuwaitiano', 'KWD', 0.30901, '2026-06-23', '00:00:00'),
(82, 'Cayman Islands Dolla', 'Dólar das Ilhas Caym', 'KYD', 0.833436, '2026-06-23', '00:00:00'),
(83, 'Kazakhstani Tenge', 'Tenge cazaque', 'KZT', 488.63, '2026-06-23', '00:00:00'),
(84, 'Lao Kip', 'Kip laosiano', 'LAK', 22146.2, '2026-06-23', '00:00:00'),
(85, 'Lebanese Pound', 'Libra libanesa', 'LBP', 89561.5, '2026-06-23', '00:00:00'),
(86, 'Sri Lankan Rupee', 'Rúpia do Sri Lanka', 'LKR', 334.602, '2026-06-23', '00:00:00'),
(87, 'Liberian Dollar', 'Dólar liberiano', 'LRD', 182.012, '2026-06-23', '00:00:00'),
(88, 'Lesotho Loti', 'Loti do Lesoto', 'LSL', 16.4915, '2026-06-23', '00:00:00'),
(89, 'Libyan Dinar', 'Dinar líbio', 'LYD', 6.41766, '2026-06-23', '00:00:00'),
(90, 'Moroccan Dirham', 'Dirham marroquino', 'MAD', 9.36025, '2026-06-23', '00:00:00'),
(91, 'Moldovan Leu', 'Leu moldavo', 'MDL', 17.6064, '2026-06-23', '00:00:00'),
(92, 'Malagasy Ariary', 'Ariary malgaxe', 'MGA', 4230, '2026-06-23', '00:00:00'),
(93, 'Macedonian Denar', 'Dinar macedônio', 'MKD', 54.1188, '2026-06-23', '00:00:00'),
(94, 'Myanmar Kyat', 'Kyat de Mianmar', 'MMK', 2099.81, '2026-06-23', '00:00:00'),
(95, 'Mongolian Tögrög', 'Tugrik mongol', 'MNT', 3569.47, '2026-06-23', '00:00:00'),
(96, 'Macanese Pataca', 'Pataca macaense', 'MOP', 8.07637, '2026-06-23', '00:00:00'),
(97, 'Mauritanian Ouguiya', 'Ouguiya mauritana', 'MRU', 39.723, '2026-06-23', '00:00:00'),
(98, 'Mauritian Rupee', 'Rúpia mauriciana', 'MUR', 47.96, '2026-06-23', '00:00:00'),
(99, 'Maldivian Rufiyaa', 'Rufiyaa maldiva', 'MVR', 15.46, '2026-06-23', '00:00:00'),
(100, 'Malawian Kwacha', 'Kwacha malawiana', 'MWK', 1734.15, '2026-06-23', '00:00:00'),
(101, 'Mexican Peso', 'Peso mexicano', 'MXN', 17.4754, '2026-06-23', '00:00:00'),
(102, 'Malaysian Ringgit', 'Ringgit malaio', 'MYR', 4.1405, '2026-06-23', '00:00:00'),
(103, 'Mozambican Metical', 'Metical moçambicano', 'MZN', 63.9, '2026-06-23', '00:00:00'),
(104, 'Namibian Dollar', 'Dólar namibiano', 'NAD', 16.4915, '2026-06-23', '00:00:00'),
(105, 'Nigerian Naira', 'Naira nigeriana', 'NGN', 1368.48, '2026-06-23', '00:00:00'),
(106, 'Nicaraguan Córdoba', 'Córdoba nicaraguense', 'NIO', 36.7989, '2026-06-23', '00:00:00'),
(107, 'Norwegian Krone', 'Coroa norueguesa', 'NOK', 9.78531, '2026-06-23', '00:00:00'),
(108, 'Nepalese Rupee', 'Rúpia nepalesa', 'NPR', 151.5, '2026-06-23', '00:00:00'),
(109, 'New Zealand Dollar', 'Dólar neozelandês', 'NZD', 1.76285, '2026-06-23', '00:00:00'),
(110, 'Omani Rial', 'Rial omanense', 'OMR', 0.384506, '2026-06-23', '00:00:00'),
(111, 'Panamanian Balboa', 'Balboa panamenho', 'PAB', 1, '2026-06-23', '00:00:00'),
(112, 'Peruvian Sol', 'Sol peruano', 'PEN', 3.38532, '2026-06-23', '00:00:00'),
(113, 'Papua New Guinean Ki', 'Kina de Papua-Nova G', 'PGK', 4.38604, '2026-06-23', '00:00:00'),
(114, 'Philippine Peso', 'Peso filipino', 'PHP', 61.229, '2026-06-23', '00:00:00'),
(115, 'Pakistani Rupee', 'Rúpia paquistanesa', 'PKR', 278.148, '2026-06-23', '00:00:00'),
(116, 'Polish Złoty', 'Złoty polonês', 'PLN', 3.75977, '2026-06-23', '00:00:00'),
(117, 'Paraguayan Guaraní', 'Guarani paraguaio', 'PYG', 6096.52, '2026-06-23', '00:00:00'),
(118, 'Qatari Riyal', 'Rial catariano', 'QAR', 3.64565, '2026-06-23', '00:00:00'),
(119, 'Romanian Leu', 'Leu romeno', 'RON', 4.6075, '2026-06-23', '00:00:00'),
(120, 'Serbian Dinar', 'Dinar sérvio', 'RSD', 103.079, '2026-06-23', '00:00:00'),
(121, 'Russian Ruble', 'Rublo russo', 'RUB', 74.5497, '2026-06-23', '00:00:00'),
(122, 'Rwandan Franc', 'Franco ruandês', 'RWF', 1466.61, '2026-06-23', '00:00:00'),
(123, 'Saudi Riyal', 'Rial saudita', 'SAR', 3.75429, '2026-06-23', '00:00:00'),
(124, 'Solomon Islands Doll', 'Dólar das Ilhas Salo', 'SBD', 8.06504, '2026-06-23', '00:00:00'),
(125, 'Seychellois Rupee', 'Rúpia seichelense', 'SCR', 14.0565, '2026-06-23', '00:00:00'),
(126, 'Sudanese Pound', 'Libra sudanesa', 'SDG', 600.5, '2026-06-23', '00:00:00'),
(127, 'Swedish Krona', 'Coroa sueca', 'SEK', 9.70949, '2026-06-23', '00:00:00'),
(128, 'Singapore Dollar', 'Dólar de Singapura', 'SGD', 1.29609, '2026-06-23', '00:00:00'),
(129, 'Saint Helena Pound', 'Libra de Santa Helen', 'SHP', 0.756883, '2026-06-23', '00:00:00'),
(130, 'Sierra Leonean Leone', 'Leone de Serra Leoa', 'SLE', 24.75, '2026-06-23', '00:00:00'),
(131, 'Old Sierra Leonean L', 'Leone antigo de Serr', 'SLL', 20969.5, '2026-06-23', '00:00:00'),
(132, 'Somali Shilling', 'Xelim somali', 'SOS', 571.589, '2026-06-23', '00:00:00'),
(133, 'Surinamese Dollar', 'Dólar surinamês', 'SRD', 37.4305, '2026-06-23', '00:00:00'),
(134, 'South Sudanese Pound', 'Libra sul-sudanesa', 'SSP', 130.26, '2026-06-23', '00:00:00'),
(135, 'Old São Tomé and Prí', 'Dobra antigo de São ', 'STD', 22281.8, '2026-06-23', '00:00:00'),
(136, 'São Tomé and Príncip', 'Dobra de São Tomé e ', 'STN', 21.4916, '2026-06-23', '00:00:00'),
(137, 'Salvadoran Colón', 'Colón salvadorenho', 'SVC', 8.75103, '2026-06-23', '00:00:00'),
(138, 'Syrian Pound', 'Libra síria', 'SYP', 13002, '2026-06-23', '00:00:00'),
(139, 'Swazi Lilangeni', 'Lilangeni de Essuatí', 'SZL', 16.4863, '2026-06-23', '00:00:00'),
(140, 'Thai Baht', 'Baht tailandês', 'THB', 33.2, '2026-06-23', '00:00:00'),
(141, 'Tajikistani Somoni', 'Somoni tadjique', 'TJS', 9.27578, '2026-06-23', '00:00:00'),
(142, 'Turkmenistani Manat', 'Manat turcomeno', 'TMT', 3.51, '2026-06-23', '00:00:00'),
(143, 'Tunisian Dinar', 'Dinar tunisiano', 'TND', 2.96032, '2026-06-23', '00:00:00'),
(144, 'Tongan Paʻanga', 'Paʻanga tonganesa', 'TOP', 2.40776, '2026-06-23', '00:00:00'),
(145, 'Turkish Lira', 'Lira turca', 'TRY', 46.4802, '2026-06-23', '00:00:00'),
(146, 'Trinidad and Tobago ', 'Dólar de Trinidad e ', 'TTD', 6.79047, '2026-06-23', '00:00:00'),
(147, 'New Taiwan Dollar', 'Novo dólar taiwanês', 'TWD', 31.6581, '2026-06-23', '00:00:00'),
(148, 'Tanzanian Shilling', 'Xelim tanzaniano', 'TZS', 2625.23, '2026-06-23', '00:00:00'),
(149, 'Ukrainian Hryvnia', 'Hryvnia ucraniana', 'UAH', 44.8927, '2026-06-23', '00:00:00'),
(150, 'Ugandan Shilling', 'Xelim ugandense', 'UGX', 3660.57, '2026-06-23', '00:00:00'),
(151, 'United States Dollar', 'Dólar americano', 'USD', 1, '2026-06-23', '00:00:00'),
(152, 'Uruguayan Peso', 'Peso uruguaio', 'UYU', 39.9263, '2026-06-23', '00:00:00'),
(153, 'Uzbekistani Som', 'Som uzbeque', 'UZS', 12015.8, '2026-06-23', '00:00:00'),
(154, 'Venezuelan Bolívar', 'Bolívar venezuelano', 'VES', 616.865, '2026-06-23', '00:00:00'),
(155, 'Vietnamese Đồng', 'Dong vietnamita', 'VND', 26322.7, '2026-06-23', '00:00:00'),
(156, 'Vanuatu Vatu', 'Vatu vanuatuense', 'VUV', 119.389, '2026-06-23', '00:00:00'),
(157, 'Samoan Tala', 'Tala samoano', 'WST', 2.74422, '2026-06-23', '00:00:00'),
(158, 'Central African CFA ', 'Franco CFA da África', 'XAF', 575.95, '2026-06-23', '00:00:00'),
(159, 'Silver, one troy oun', 'Prata, onça troy', 'XAG', 0.0161526, '2026-06-23', '00:00:00'),
(160, 'Gold, one troy ounce', 'Ouro, onça troy', 'XAU', 0.0002431, '2026-06-23', '00:00:00'),
(161, 'East Caribbean Dolla', 'Dólar do Caribe Orie', 'XCD', 2.70255, '2026-06-23', '00:00:00'),
(162, 'Caribbean Guilder', 'Florim caribenho', 'XCG', 1.8024, '2026-06-23', '00:00:00'),
(163, 'Special Drawing Righ', 'Direitos Especiais d', 'XDR', 0.713895, '2026-06-23', '00:00:00'),
(164, 'West African CFA Fra', 'Franco CFA da África', 'XOF', 575.95, '2026-06-23', '00:00:00'),
(165, 'Palladium, one troy ', 'Paládio, onça troy', 'XPD', 0.00080698, '2026-06-23', '00:00:00'),
(166, 'CFP Franc', 'Franco CFP', 'XPF', 104.777, '2026-06-23', '00:00:00'),
(167, 'Platinum, one troy o', 'Platina, onça troy', 'XPT', 0.00061182, '2026-06-23', '00:00:00'),
(168, 'Yemeni Rial', 'Rial iemenita', 'YER', 238.65, '2026-06-23', '00:00:00'),
(169, 'South African Rand', 'Rand sul-africano', 'ZAR', 16.4924, '2026-06-23', '00:00:00'),
(170, 'Zambian Kwacha', 'Kwacha zambiana', 'ZMW', 17.9407, '2026-06-23', '00:00:00'),
(171, 'Zimbabwe Gold / ZiG', 'Zimbabwe Gold / ZiG', 'ZWG', 25.3626, '2026-06-23', '00:00:00'),
(172, 'Zimbabwean Dollar', 'Dólar zimbabuano', 'ZWL', 322, '2026-06-23', '00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jsonscurrencies`
--

CREATE TABLE `jsonscurrencies` (
  `id` int(11) NOT NULL,
  `json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`json`)),
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jsonscurrencies`
--

INSERT INTO `jsonscurrencies` (`id`, `json`, `date`, `time`) VALUES
(1, '{\n  \"disclaimer\": \"Usage subject to terms: https://openexchangerates.org/terms\",\n  \"license\": \"https://openexchangerates.org/license\",\n  \"timestamp\": 1781625600,\n  \"base\": \"USD\",\n  \"rates\": {\n    \"AED\": 3.6725,\n    \"AFN\": 63,\n    \"ALL\": 81.708439,\n    \"AMD\": 368.691836,\n    \"ANG\": 1.79,\n    \"AOA\": 912.6,\n    \"ARS\": 1432.7521,\n    \"AUD\": 1.413205,\n    \"AWG\": 1.8025,\n    \"AZN\": 1.7,\n    \"BAM\": 1.685177,\n    \"BBD\": 2,\n    \"BDT\": 122.817895,\n    \"BGN\": 1.68434,\n    \"BHD\": 0.377305,\n    \"BIF\": 2994.040845,\n    \"BMD\": 1,\n    \"BND\": 1.281762,\n    \"BOB\": 6.920735,\n    \"BRL\": 5.0936,\n    \"BSD\": 1,\n    \"BTC\": 0.000015190128,\n    \"BTN\": 94.560527,\n    \"BWP\": 13.406112,\n    \"BYN\": 2.76997,\n    \"BZD\": 2.012252,\n    \"CAD\": 1.398364,\n    \"CDF\": 2319.685681,\n    \"CHF\": 0.792818,\n    \"CLF\": 0.022529,\n    \"CLP\": 886,\n    \"CNH\": 6.755409,\n    \"CNY\": 6.7589,\n    \"COP\": 3454.36,\n    \"CRC\": 455.716523,\n    \"CUC\": 1,\n    \"CUP\": 25.75,\n    \"CVE\": 95.008533,\n    \"CZK\": 20.797349,\n    \"DJF\": 178.167991,\n    \"DKK\": 6.435939,\n    \"DOP\": 58.694283,\n    \"DZD\": 132.878056,\n    \"EGP\": 50.1225,\n    \"ERN\": 15,\n    \"ETB\": 161.303999,\n    \"EUR\": 0.86101,\n    \"FJD\": 2.21345,\n    \"FKP\": 0.744189,\n    \"GBP\": 0.744189,\n    \"GEL\": 2.645,\n    \"GGP\": 0.744189,\n    \"GHS\": 11.175,\n    \"GIP\": 0.744189,\n    \"GMD\": 72.50001,\n    \"GNF\": 8763.556973,\n    \"GTQ\": 7.626359,\n    \"GYD\": 209.290075,\n    \"HKD\": 7.833552,\n    \"HNL\": 26.754264,\n    \"HRK\": 6.488629,\n    \"HTG\": 130.666303,\n    \"HUF\": 300.759558,\n    \"IDR\": 17727.677767,\n    \"ILS\": 2.91565,\n    \"IMP\": 0.744189,\n    \"INR\": 94.460197,\n    \"IQD\": 1310.703304,\n    \"IRR\": 1375752.5,\n    \"ISK\": 124.33,\n    \"JEP\": 0.744189,\n    \"JMD\": 158.238451,\n    \"JOD\": 0.709,\n    \"JPY\": 160.390875,\n    \"KES\": 129.45,\n    \"KGS\": 87.45,\n    \"KHR\": 4017.767364,\n    \"KMF\": 424.999927,\n    \"KPW\": 900,\n    \"KRW\": 1508.380487,\n    \"KWD\": 0.308178,\n    \"KYD\": 0.8338,\n    \"KZT\": 487.920121,\n    \"LAK\": 22016.405346,\n    \"LBP\": 89580.846135,\n    \"LKR\": 335.185865,\n    \"LRD\": 182.097035,\n    \"LSL\": 16.148995,\n    \"LYD\": 6.374399,\n    \"MAD\": 9.250461,\n    \"MDL\": 17.397445,\n    \"MGA\": 4157.348058,\n    \"MKD\": 53.123005,\n    \"MMK\": 2099.81,\n    \"MNT\": 3569.47,\n    \"MOP\": 8.072446,\n    \"MRU\": 39.93262,\n    \"MUR\": 47.240002,\n    \"MVR\": 15.45,\n    \"MWK\": 1734.895781,\n    \"MXN\": 17.194,\n    \"MYR\": 4.0686,\n    \"MZN\": 63.909994,\n    \"NAD\": 16.148855,\n    \"NGN\": 1357.86,\n    \"NIO\": 36.817799,\n    \"NOK\": 9.480915,\n    \"NPR\": 151.295878,\n    \"NZD\": 1.712392,\n    \"OMR\": 0.384509,\n    \"PAB\": 1,\n    \"PEN\": 3.408382,\n    \"PGK\": 4.383153,\n    \"PHP\": 60.233496,\n    \"PKR\": 278.370677,\n    \"PLN\": 3.649002,\n    \"PYG\": 6132.126635,\n    \"QAR\": 3.657654,\n    \"RON\": 4.5014,\n    \"RSD\": 101.057676,\n    \"RUB\": 72.507516,\n    \"RWF\": 1483.72706,\n    \"SAR\": 3.752095,\n    \"SBD\": 8.065041,\n    \"SCR\": 13.834809,\n    \"SDG\": 600.5,\n    \"SEK\": 9.360687,\n    \"SGD\": 1.281565,\n    \"SHP\": 0.744189,\n    \"SLE\": 24.75,\n    \"SLL\": 20969.5,\n    \"SOS\": 571.772846,\n    \"SRD\": 37.332,\n    \"SSP\": 130.26,\n    \"STD\": 22281.8,\n    \"STN\": 21.109953,\n    \"SVC\": 8.754244,\n    \"SYP\": 13002,\n    \"SZL\": 16.17064,\n    \"THB\": 32.4905,\n    \"TJS\": 9.274725,\n    \"TMT\": 3.5,\n    \"TND\": 2.928683,\n    \"TOP\": 2.40776,\n    \"TRY\": 46.299555,\n    \"TTD\": 6.796543,\n    \"TWD\": 31.510499,\n    \"TZS\": 2620.018,\n    \"UAH\": 44.808888,\n    \"UGX\": 3701.535454,\n    \"USD\": 1,\n    \"UYU\": 40.312622,\n    \"UZS\": 12016.412171,\n    \"VES\": 591.775165,\n    \"VND\": 26301.946344,\n    \"VUV\": 119.389,\n    \"WST\": 2.74422,\n    \"XAF\": 564.785431,\n    \"XAG\": 0.01427277,\n    \"XAU\": 0.00023066,\n    \"XCD\": 2.70255,\n    \"XCG\": 1.803205,\n    \"XDR\": 0.703697,\n    \"XOF\": 564.785431,\n    \"XPD\": 0.00073301,\n    \"XPF\": 102.745804,\n    \"XPT\": 0.00055361,\n    \"YER\": 238.600042,\n    \"ZAR\": 16.181769,\n    \"ZMW\": 17.684109,\n    \"ZWG\": 25.3626,\n    \"ZWL\": 322\n  }\n}', '2016-06-26', '18:04:00'),
(2, '{\n  \"disclaimer\": \"Usage subject to terms: https://openexchangerates.org/terms\",\n  \"license\": \"https://openexchangerates.org/license\",\n  \"timestamp\": 1781629201,\n  \"base\": \"USD\",\n  \"rates\": {\n    \"AED\": 3.6731,\n    \"AFN\": 63.499997,\n    \"ALL\": 81.708439,\n    \"AMD\": 368.691836,\n    \"ANG\": 1.79,\n    \"AOA\": 912.6,\n    \"ARS\": 1433.027719,\n    \"AUD\": 1.413734,\n    \"AWG\": 1.8025,\n    \"AZN\": 1.7,\n    \"BAM\": 1.685177,\n    \"BBD\": 2,\n    \"BDT\": 122.817895,\n    \"BGN\": 1.684086,\n    \"BHD\": 0.377305,\n    \"BIF\": 2994.040845,\n    \"BMD\": 1,\n    \"BND\": 1.281762,\n    \"BOB\": 6.920735,\n    \"BRL\": 5.0981,\n    \"BSD\": 1,\n    \"BTC\": 0.000015215684,\n    \"BTN\": 94.560527,\n    \"BWP\": 13.406112,\n    \"BYN\": 2.76997,\n    \"BZD\": 2.012252,\n    \"CAD\": 1.398565,\n    \"CDF\": 2319.685681,\n    \"CHF\": 0.792685,\n    \"CLF\": 0.022535,\n    \"CLP\": 886.93,\n    \"CNH\": 6.756228,\n    \"CNY\": 6.7598,\n    \"COP\": 3456.57,\n    \"CRC\": 455.716523,\n    \"CUC\": 1,\n    \"CUP\": 25.75,\n    \"CVE\": 95.008533,\n    \"CZK\": 20.800525,\n    \"DJF\": 178.167991,\n    \"DKK\": 6.436532,\n    \"DOP\": 58.694283,\n    \"DZD\": 133.008,\n    \"EGP\": 50.1185,\n    \"ERN\": 15,\n    \"ETB\": 161.303999,\n    \"EUR\": 0.861078,\n    \"FJD\": 2.21195,\n    \"FKP\": 0.744661,\n    \"GBP\": 0.744661,\n    \"GEL\": 2.645,\n    \"GGP\": 0.744661,\n    \"GHS\": 11.175,\n    \"GIP\": 0.744661,\n    \"GMD\": 72.50001,\n    \"GNF\": 8763.556973,\n    \"GTQ\": 7.626359,\n    \"GYD\": 209.290075,\n    \"HKD\": 7.833573,\n    \"HNL\": 26.754264,\n    \"HRK\": 6.487646,\n    \"HTG\": 130.666303,\n    \"HUF\": 300.773053,\n    \"IDR\": 17735.527835,\n    \"ILS\": 2.91565,\n    \"IMP\": 0.744661,\n    \"INR\": 94.450079,\n    \"IQD\": 1310.703304,\n    \"IRR\": 1375752.5,\n    \"ISK\": 124.34,\n    \"JEP\": 0.744661,\n    \"JMD\": 158.238451,\n    \"JOD\": 0.709,\n    \"JPY\": 160.3955,\n    \"KES\": 129.42,\n    \"KGS\": 87.45,\n    \"KHR\": 4017.767364,\n    \"KMF\": 424.999927,\n    \"KPW\": 900,\n    \"KRW\": 1508.159595,\n    \"KWD\": 0.308147,\n    \"KYD\": 0.8338,\n    \"KZT\": 487.920121,\n    \"LAK\": 22016.405346,\n    \"LBP\": 89580.846135,\n    \"LKR\": 335.185865,\n    \"LRD\": 182.097035,\n    \"LSL\": 16.148995,\n    \"LYD\": 6.374399,\n    \"MAD\": 9.250461,\n    \"MDL\": 17.397445,\n    \"MGA\": 4157.348058,\n    \"MKD\": 53.072775,\n    \"MMK\": 2099.81,\n    \"MNT\": 3569.47,\n    \"MOP\": 8.072446,\n    \"MRU\": 39.93262,\n    \"MUR\": 47.240002,\n    \"MVR\": 15.45,\n    \"MWK\": 1734.895781,\n    \"MXN\": 17.20163,\n    \"MYR\": 4.0686,\n    \"MZN\": 63.909994,\n    \"NAD\": 16.148855,\n    \"NGN\": 1357.89,\n    \"NIO\": 36.817799,\n    \"NOK\": 9.477793,\n    \"NPR\": 151.295878,\n    \"NZD\": 1.712453,\n    \"OMR\": 0.384507,\n    \"PAB\": 1,\n    \"PEN\": 3.408382,\n    \"PGK\": 4.383153,\n    \"PHP\": 60.261002,\n    \"PKR\": 278.370677,\n    \"PLN\": 3.648998,\n    \"PYG\": 6132.126635,\n    \"QAR\": 3.657654,\n    \"RON\": 4.5023,\n    \"RSD\": 101.046,\n    \"RUB\": 72.505594,\n    \"RWF\": 1483.72706,\n    \"SAR\": 3.752095,\n    \"SBD\": 8.065041,\n    \"SCR\": 13.834809,\n    \"SDG\": 600.5,\n    \"SEK\": 9.356107,\n    \"SGD\": 1.28174,\n    \"SHP\": 0.744661,\n    \"SLE\": 24.75,\n    \"SLL\": 20969.5,\n    \"SOS\": 571.772846,\n    \"SRD\": 37.332,\n    \"SSP\": 130.26,\n    \"STD\": 22281.8,\n    \"STN\": 21.109953,\n    \"SVC\": 8.754244,\n    \"SYP\": 13002,\n    \"SZL\": 16.17064,\n    \"THB\": 32.4855,\n    \"TJS\": 9.274725,\n    \"TMT\": 3.5,\n    \"TND\": 2.928683,\n    \"TOP\": 2.40776,\n    \"TRY\": 46.297902,\n    \"TTD\": 6.796543,\n    \"TWD\": 31.515199,\n    \"TZS\": 2620.003,\n    \"UAH\": 44.808888,\n    \"UGX\": 3701.535454,\n    \"USD\": 1,\n    \"UYU\": 40.312622,\n    \"UZS\": 12016.412171,\n    \"VES\": 591.775165,\n    \"VND\": 26301.946344,\n    \"VUV\": 119.389,\n    \"WST\": 2.74422,\n    \"XAF\": 564.830321,\n    \"XAG\": 0.01426411,\n    \"XAU\": 0.00023038,\n    \"XCD\": 2.70255,\n    \"XCG\": 1.803205,\n    \"XDR\": 0.703697,\n    \"XOF\": 564.830321,\n    \"XPD\": 0.00073301,\n    \"XPF\": 102.753971,\n    \"XPT\": 0.00055361,\n    \"YER\": 238.600042,\n    \"ZAR\": 16.191357,\n    \"ZMW\": 17.684109,\n    \"ZWG\": 25.3626,\n    \"ZWL\": 322\n  }\n}', '2016-06-26', '14:47:00'),
(3, '{\n  \"disclaimer\": \"Usage subject to terms: https://openexchangerates.org/terms\",\n  \"license\": \"https://openexchangerates.org/license\",\n  \"timestamp\": 1781629201,\n  \"base\": \"USD\",\n  \"rates\": {\n    \"AED\": 3.6731,\n    \"AFN\": 63.499997,\n    \"ALL\": 81.708439,\n    \"AMD\": 368.691836,\n    \"ANG\": 1.79,\n    \"AOA\": 912.6,\n    \"ARS\": 1433.027719,\n    \"AUD\": 1.413734,\n    \"AWG\": 1.8025,\n    \"AZN\": 1.7,\n    \"BAM\": 1.685177,\n    \"BBD\": 2,\n    \"BDT\": 122.817895,\n    \"BGN\": 1.684086,\n    \"BHD\": 0.377305,\n    \"BIF\": 2994.040845,\n    \"BMD\": 1,\n    \"BND\": 1.281762,\n    \"BOB\": 6.920735,\n    \"BRL\": 5.0981,\n    \"BSD\": 1,\n    \"BTC\": 0.000015215684,\n    \"BTN\": 94.560527,\n    \"BWP\": 13.406112,\n    \"BYN\": 2.76997,\n    \"BZD\": 2.012252,\n    \"CAD\": 1.398565,\n    \"CDF\": 2319.685681,\n    \"CHF\": 0.792685,\n    \"CLF\": 0.022535,\n    \"CLP\": 886.93,\n    \"CNH\": 6.756228,\n    \"CNY\": 6.7598,\n    \"COP\": 3456.57,\n    \"CRC\": 455.716523,\n    \"CUC\": 1,\n    \"CUP\": 25.75,\n    \"CVE\": 95.008533,\n    \"CZK\": 20.800525,\n    \"DJF\": 178.167991,\n    \"DKK\": 6.436532,\n    \"DOP\": 58.694283,\n    \"DZD\": 133.008,\n    \"EGP\": 50.1185,\n    \"ERN\": 15,\n    \"ETB\": 161.303999,\n    \"EUR\": 0.861078,\n    \"FJD\": 2.21195,\n    \"FKP\": 0.744661,\n    \"GBP\": 0.744661,\n    \"GEL\": 2.645,\n    \"GGP\": 0.744661,\n    \"GHS\": 11.175,\n    \"GIP\": 0.744661,\n    \"GMD\": 72.50001,\n    \"GNF\": 8763.556973,\n    \"GTQ\": 7.626359,\n    \"GYD\": 209.290075,\n    \"HKD\": 7.833573,\n    \"HNL\": 26.754264,\n    \"HRK\": 6.487646,\n    \"HTG\": 130.666303,\n    \"HUF\": 300.773053,\n    \"IDR\": 17735.527835,\n    \"ILS\": 2.91565,\n    \"IMP\": 0.744661,\n    \"INR\": 94.450079,\n    \"IQD\": 1310.703304,\n    \"IRR\": 1375752.5,\n    \"ISK\": 124.34,\n    \"JEP\": 0.744661,\n    \"JMD\": 158.238451,\n    \"JOD\": 0.709,\n    \"JPY\": 160.3955,\n    \"KES\": 129.42,\n    \"KGS\": 87.45,\n    \"KHR\": 4017.767364,\n    \"KMF\": 424.999927,\n    \"KPW\": 900,\n    \"KRW\": 1508.159595,\n    \"KWD\": 0.308147,\n    \"KYD\": 0.8338,\n    \"KZT\": 487.920121,\n    \"LAK\": 22016.405346,\n    \"LBP\": 89580.846135,\n    \"LKR\": 335.185865,\n    \"LRD\": 182.097035,\n    \"LSL\": 16.148995,\n    \"LYD\": 6.374399,\n    \"MAD\": 9.250461,\n    \"MDL\": 17.397445,\n    \"MGA\": 4157.348058,\n    \"MKD\": 53.072775,\n    \"MMK\": 2099.81,\n    \"MNT\": 3569.47,\n    \"MOP\": 8.072446,\n    \"MRU\": 39.93262,\n    \"MUR\": 47.240002,\n    \"MVR\": 15.45,\n    \"MWK\": 1734.895781,\n    \"MXN\": 17.20163,\n    \"MYR\": 4.0686,\n    \"MZN\": 63.909994,\n    \"NAD\": 16.148855,\n    \"NGN\": 1357.89,\n    \"NIO\": 36.817799,\n    \"NOK\": 9.477793,\n    \"NPR\": 151.295878,\n    \"NZD\": 1.712453,\n    \"OMR\": 0.384507,\n    \"PAB\": 1,\n    \"PEN\": 3.408382,\n    \"PGK\": 4.383153,\n    \"PHP\": 60.261002,\n    \"PKR\": 278.370677,\n    \"PLN\": 3.648998,\n    \"PYG\": 6132.126635,\n    \"QAR\": 3.657654,\n    \"RON\": 4.5023,\n    \"RSD\": 101.046,\n    \"RUB\": 72.505594,\n    \"RWF\": 1483.72706,\n    \"SAR\": 3.752095,\n    \"SBD\": 8.065041,\n    \"SCR\": 13.834809,\n    \"SDG\": 600.5,\n    \"SEK\": 9.356107,\n    \"SGD\": 1.28174,\n    \"SHP\": 0.744661,\n    \"SLE\": 24.75,\n    \"SLL\": 20969.5,\n    \"SOS\": 571.772846,\n    \"SRD\": 37.332,\n    \"SSP\": 130.26,\n    \"STD\": 22281.8,\n    \"STN\": 21.109953,\n    \"SVC\": 8.754244,\n    \"SYP\": 13002,\n    \"SZL\": 16.17064,\n    \"THB\": 32.4855,\n    \"TJS\": 9.274725,\n    \"TMT\": 3.5,\n    \"TND\": 2.928683,\n    \"TOP\": 2.40776,\n    \"TRY\": 46.297902,\n    \"TTD\": 6.796543,\n    \"TWD\": 31.515199,\n    \"TZS\": 2620.003,\n    \"UAH\": 44.808888,\n    \"UGX\": 3701.535454,\n    \"USD\": 1,\n    \"UYU\": 40.312622,\n    \"UZS\": 12016.412171,\n    \"VES\": 591.775165,\n    \"VND\": 26301.946344,\n    \"VUV\": 119.389,\n    \"WST\": 2.74422,\n    \"XAF\": 564.830321,\n    \"XAG\": 0.01426411,\n    \"XAU\": 0.00023038,\n    \"XCD\": 2.70255,\n    \"XCG\": 1.803205,\n    \"XDR\": 0.703697,\n    \"XOF\": 564.830321,\n    \"XPD\": 0.00073301,\n    \"XPF\": 102.753971,\n    \"XPT\": 0.00055361,\n    \"YER\": 238.600042,\n    \"ZAR\": 16.191357,\n    \"ZMW\": 17.684109,\n    \"ZWG\": 25.3626,\n    \"ZWL\": 322\n  }\n}', '2016-06-26', '14:49:00'),
(4, '{\n  \"disclaimer\": \"Usage subject to terms: https://openexchangerates.org/terms\",\n  \"license\": \"https://openexchangerates.org/license\",\n  \"timestamp\": 1782136800,\n  \"base\": \"USD\",\n  \"rates\": {\n    \"AED\": 3.6725,\n    \"AFN\": 63.499997,\n    \"ALL\": 82.257093,\n    \"AMD\": 368.07,\n    \"ANG\": 1.79,\n    \"AOA\": 913.116,\n    \"ARS\": 1455.306,\n    \"AUD\": 1.427949,\n    \"AWG\": 1.8025,\n    \"AZN\": 1.7,\n    \"BAM\": 1.707839,\n    \"BBD\": 2,\n    \"BDT\": 122.896639,\n    \"BGN\": 1.71066,\n    \"BHD\": 0.37723,\n    \"BIF\": 2983.177602,\n    \"BMD\": 1,\n    \"BND\": 1.293759,\n    \"BOB\": 6.91239,\n    \"BRL\": 5.1614,\n    \"BSD\": 1,\n    \"BTC\": 0.000015277483,\n    \"BTN\": 94.655909,\n    \"BWP\": 13.576786,\n    \"BYN\": 2.799012,\n    \"BZD\": 2.01198,\n    \"CAD\": 1.416915,\n    \"CDF\": 2297.869548,\n    \"CHF\": 0.809648,\n    \"CLF\": 0.022973,\n    \"CLP\": 904.14,\n    \"CNH\": 6.781365,\n    \"CNY\": 6.7697,\n    \"COP\": 3418.78,\n    \"CRC\": 453.811135,\n    \"CUC\": 1,\n    \"CUP\": 25.75,\n    \"CVE\": 96.285323,\n    \"CZK\": 21.171156,\n    \"DJF\": 178.145172,\n    \"DKK\": 6.540154,\n    \"DOP\": 58.479371,\n    \"DZD\": 133.504693,\n    \"EGP\": 49.8203,\n    \"ERN\": 15,\n    \"ETB\": 161.28398,\n    \"EUR\": 0.874999,\n    \"FJD\": 2.24775,\n    \"FKP\": 0.755341,\n    \"GBP\": 0.755341,\n    \"GEL\": 2.65,\n    \"GGP\": 0.755341,\n    \"GHS\": 11.229578,\n    \"GIP\": 0.755341,\n    \"GMD\": 73.500003,\n    \"GNF\": 8765.345549,\n    \"GTQ\": 7.628428,\n    \"GYD\": 209.275278,\n    \"HKD\": 7.839905,\n    \"HNL\": 26.762373,\n    \"HRK\": 6.590028,\n    \"HTG\": 130.676984,\n    \"HUF\": 308.463739,\n    \"IDR\": 17825.657104,\n    \"ILS\": 2.963305,\n    \"IMP\": 0.755341,\n    \"INR\": 94.565246,\n    \"IQD\": 1310.523254,\n    \"IRR\": 1375000,\n    \"ISK\": 125.99,\n    \"JEP\": 0.755341,\n    \"JMD\": 158.069817,\n    \"JOD\": 0.709,\n    \"JPY\": 161.8975,\n    \"KES\": 129.4,\n    \"KGS\": 87.45,\n    \"KHR\": 4016.777109,\n    \"KMF\": 429.500172,\n    \"KPW\": 900,\n    \"KRW\": 1537.528926,\n    \"KWD\": 0.30857,\n    \"KYD\": 0.833661,\n    \"KZT\": 487.587313,\n    \"LAK\": 22093.768267,\n    \"LBP\": 89575.292135,\n    \"LKR\": 334.503197,\n    \"LRD\": 182.07459,\n    \"LSL\": 16.436923,\n    \"LYD\": 6.413783,\n    \"MAD\": 9.325876,\n    \"MDL\": 17.59184,\n    \"MGA\": 4219.40205,\n    \"MKD\": 53.872981,\n    \"MMK\": 2099.81,\n    \"MNT\": 3569.47,\n    \"MOP\": 8.077961,\n    \"MRU\": 40.00035,\n    \"MUR\": 47.810001,\n    \"MVR\": 15.45,\n    \"MWK\": 1734.64457,\n    \"MXN\": 17.341205,\n    \"MYR\": 4.1491,\n    \"MZN\": 63.909994,\n    \"NAD\": 16.436923,\n    \"NGN\": 1367.32,\n    \"NIO\": 36.814849,\n    \"NOK\": 9.688255,\n    \"NPR\": 151.449076,\n    \"NZD\": 1.747396,\n    \"OMR\": 0.384497,\n    \"PAB\": 1,\n    \"PEN\": 3.385028,\n    \"PGK\": 4.456902,\n    \"PHP\": 61.069001,\n    \"PKR\": 278.233739,\n    \"PLN\": 3.73885,\n    \"PYG\": 6098.552827,\n    \"QAR\": 3.646906,\n    \"RON\": 4.5839,\n    \"RSD\": 102.677258,\n    \"RUB\": 73.850016,\n    \"RWF\": 1465.169986,\n    \"SAR\": 3.753792,\n    \"SBD\": 8.061424,\n    \"SCR\": 13.673674,\n    \"SDG\": 600.5,\n    \"SEK\": 9.6089,\n    \"SGD\": 1.29388,\n    \"SHP\": 0.755341,\n    \"SLE\": 24.75,\n    \"SLL\": 20969.5,\n    \"SOS\": 571.694983,\n    \"SRD\": 37.4025,\n    \"SSP\": 130.26,\n    \"STD\": 22281.8,\n    \"STN\": 21.39383,\n    \"SVC\": 8.753133,\n    \"SYP\": 13002,\n    \"SZL\": 16.433081,\n    \"THB\": 32.9205,\n    \"TJS\": 9.278635,\n    \"TMT\": 3.5,\n    \"TND\": 2.957937,\n    \"TOP\": 2.40776,\n    \"TRY\": 46.462368,\n    \"TTD\": 6.784027,\n    \"TWD\": 31.628613,\n    \"TZS\": 2628.254,\n    \"UAH\": 44.991836,\n    \"UGX\": 3651.79347,\n    \"USD\": 1,\n    \"UYU\": 40.002095,\n    \"UZS\": 11989.161521,\n    \"VES\": 606.632962,\n    \"VND\": 26319.252989,\n    \"VUV\": 119.389,\n    \"WST\": 2.74422,\n    \"XAF\": 573.961446,\n    \"XAG\": 0.01503084,\n    \"XAU\": 0.00023809,\n    \"XCD\": 2.70255,\n    \"XCG\": 1.802932,\n    \"XDR\": 0.71169,\n    \"XOF\": 573.961446,\n    \"XPD\": 0.00078475,\n    \"XPF\": 104.415106,\n    \"XPT\": 0.00059344,\n    \"YER\": 238.600042,\n    \"ZAR\": 16.42339,\n    \"ZMW\": 17.731555,\n    \"ZWG\": 25.3626,\n    \"ZWL\": 322\n  }\n}', '0000-00-00', '11:50:57'),
(5, '{\n  \"disclaimer\": \"Usage subject to terms: https://openexchangerates.org/terms\",\n  \"license\": \"https://openexchangerates.org/license\",\n  \"timestamp\": 1782140400,\n  \"base\": \"USD\",\n  \"rates\": {\n    \"AED\": 3.6725,\n    \"AFN\": 63.499997,\n    \"ALL\": 82.257093,\n    \"AMD\": 368.07,\n    \"ANG\": 1.79,\n    \"AOA\": 913.116,\n    \"ARS\": 1457.2448,\n    \"AUD\": 1.426642,\n    \"AWG\": 1.8025,\n    \"AZN\": 1.7,\n    \"BAM\": 1.707839,\n    \"BBD\": 2,\n    \"BDT\": 122.896639,\n    \"BGN\": 1.708916,\n    \"BHD\": 0.37723,\n    \"BIF\": 2983.177602,\n    \"BMD\": 1,\n    \"BND\": 1.293759,\n    \"BOB\": 6.91239,\n    \"BRL\": 5.1519,\n    \"BSD\": 1,\n    \"BTC\": 0.000015414028,\n    \"BTN\": 94.655909,\n    \"BWP\": 13.576786,\n    \"BYN\": 2.799012,\n    \"BZD\": 2.01198,\n    \"CAD\": 1.415125,\n    \"CDF\": 2297.869548,\n    \"CHF\": 0.807803,\n    \"CLF\": 0.022973,\n    \"CLP\": 904.16,\n    \"CNH\": 6.777473,\n    \"CNY\": 6.7703,\n    \"COP\": 3424.58,\n    \"CRC\": 453.811135,\n    \"CUC\": 1,\n    \"CUP\": 25.75,\n    \"CVE\": 96.285323,\n    \"CZK\": 21.1533,\n    \"DJF\": 178.145172,\n    \"DKK\": 6.531031,\n    \"DOP\": 58.479371,\n    \"DZD\": 133.456171,\n    \"EGP\": 49.7698,\n    \"ERN\": 15,\n    \"ETB\": 161.28398,\n    \"EUR\": 0.873761,\n    \"FJD\": 2.24775,\n    \"FKP\": 0.754029,\n    \"GBP\": 0.754029,\n    \"GEL\": 2.65,\n    \"GGP\": 0.754029,\n    \"GHS\": 11.229578,\n    \"GIP\": 0.754029,\n    \"GMD\": 73.500003,\n    \"GNF\": 8765.345549,\n    \"GTQ\": 7.628428,\n    \"GYD\": 209.275278,\n    \"HKD\": 7.840605,\n    \"HNL\": 26.762373,\n    \"HRK\": 6.583313,\n    \"HTG\": 130.676984,\n    \"HUF\": 308.116128,\n    \"IDR\": 17823.915156,\n    \"ILS\": 2.97133,\n    \"IMP\": 0.754029,\n    \"INR\": 94.541054,\n    \"IQD\": 1310.523254,\n    \"IRR\": 1375000,\n    \"ISK\": 125.81,\n    \"JEP\": 0.754029,\n    \"JMD\": 158.069817,\n    \"JOD\": 0.709,\n    \"JPY\": 161.329875,\n    \"KES\": 129.42,\n    \"KGS\": 87.45,\n    \"KHR\": 4016.777109,\n    \"KMF\": 429.500172,\n    \"KPW\": 900,\n    \"KRW\": 1536.759663,\n    \"KWD\": 0.308579,\n    \"KYD\": 0.833661,\n    \"KZT\": 487.587313,\n    \"LAK\": 22093.768267,\n    \"LBP\": 89575.292135,\n    \"LKR\": 334.503197,\n    \"LRD\": 182.07459,\n    \"LSL\": 16.436923,\n    \"LYD\": 6.413783,\n    \"MAD\": 9.325876,\n    \"MDL\": 17.59184,\n    \"MGA\": 4219.40205,\n    \"MKD\": 53.85089,\n    \"MMK\": 2099.81,\n    \"MNT\": 3569.47,\n    \"MOP\": 8.077961,\n    \"MRU\": 40.00035,\n    \"MUR\": 47.810001,\n    \"MVR\": 15.45,\n    \"MWK\": 1734.64457,\n    \"MXN\": 17.31691,\n    \"MYR\": 4.1497,\n    \"MZN\": 63.909994,\n    \"NAD\": 16.436923,\n    \"NGN\": 1367.55,\n    \"NIO\": 36.814849,\n    \"NOK\": 9.672006,\n    \"NPR\": 151.449076,\n    \"NZD\": 1.744527,\n    \"OMR\": 0.384522,\n    \"PAB\": 1,\n    \"PEN\": 3.385028,\n    \"PGK\": 4.456902,\n    \"PHP\": 61.078999,\n    \"PKR\": 278.233739,\n    \"PLN\": 3.737026,\n    \"PYG\": 6098.552827,\n    \"QAR\": 3.646906,\n    \"RON\": 4.5766,\n    \"RSD\": 102.576471,\n    \"RUB\": 73.853235,\n    \"RWF\": 1465.169986,\n    \"SAR\": 3.753792,\n    \"SBD\": 8.061424,\n    \"SCR\": 13.674407,\n    \"SDG\": 600.5,\n    \"SEK\": 9.60413,\n    \"SGD\": 1.292919,\n    \"SHP\": 0.754029,\n    \"SLE\": 24.75,\n    \"SLL\": 20969.5,\n    \"SOS\": 571.694983,\n    \"SRD\": 37.4305,\n    \"SSP\": 130.26,\n    \"STD\": 22281.8,\n    \"STN\": 21.39383,\n    \"SVC\": 8.753133,\n    \"SYP\": 13002,\n    \"SZL\": 16.433081,\n    \"THB\": 32.912,\n    \"TJS\": 9.278635,\n    \"TMT\": 3.5,\n    \"TND\": 2.957937,\n    \"TOP\": 2.40776,\n    \"TRY\": 46.462249,\n    \"TTD\": 6.784027,\n    \"TWD\": 31.6275,\n    \"TZS\": 2628.368,\n    \"UAH\": 44.991836,\n    \"UGX\": 3651.79347,\n    \"USD\": 1,\n    \"UYU\": 40.002095,\n    \"UZS\": 11989.161521,\n    \"VES\": 606.632962,\n    \"VND\": 26319.252989,\n    \"VUV\": 119.389,\n    \"WST\": 2.74422,\n    \"XAF\": 573.149339,\n    \"XAG\": 0.01513884,\n    \"XAU\": 0.00023818,\n    \"XCD\": 2.70255,\n    \"XCG\": 1.802932,\n    \"XDR\": 0.71169,\n    \"XOF\": 573.149339,\n    \"XPD\": 0.00078475,\n    \"XPF\": 104.267367,\n    \"XPT\": 0.00059344,\n    \"YER\": 238.600042,\n    \"ZAR\": 16.385175,\n    \"ZMW\": 17.731555,\n    \"ZWG\": 25.3626,\n    \"ZWL\": 322\n  }\n}', '2026-06-22', '12:04:11'),
(6, '{\n  \"disclaimer\": \"Usage subject to terms: https://openexchangerates.org/terms\",\n  \"license\": \"https://openexchangerates.org/license\",\n  \"timestamp\": 1782219600,\n  \"base\": \"USD\",\n  \"rates\": {\n    \"AED\": 3.6725,\n    \"AFN\": 63.249998,\n    \"ALL\": 82.633039,\n    \"AMD\": 368.08,\n    \"ANG\": 1.79,\n    \"AOA\": 912.6,\n    \"ARS\": 1461.4986,\n    \"AUD\": 1.441588,\n    \"AWG\": 1.8,\n    \"AZN\": 1.7,\n    \"BAM\": 1.715644,\n    \"BBD\": 2,\n    \"BDT\": 122.861809,\n    \"BGN\": 1.717322,\n    \"BHD\": 0.3772,\n    \"BIF\": 2988.441354,\n    \"BMD\": 1,\n    \"BND\": 1.295549,\n    \"BOB\": 6.92556,\n    \"BRL\": 5.1853,\n    \"BSD\": 1,\n    \"BTC\": 0.000016081648,\n    \"BTN\": 94.68762,\n    \"BWP\": 13.602569,\n    \"BYN\": 2.808821,\n    \"BZD\": 2.011333,\n    \"CAD\": 1.418737,\n    \"CDF\": 2299.429916,\n    \"CHF\": 0.809269,\n    \"CLF\": 0.023179,\n    \"CLP\": 912.21,\n    \"CNH\": 6.791586,\n    \"CNY\": 6.7838,\n    \"COP\": 3436.776763,\n    \"CRC\": 453.692041,\n    \"CUC\": 1,\n    \"CUP\": 25.75,\n    \"CVE\": 96.725372,\n    \"CZK\": 21.254175,\n    \"DJF\": 178.090873,\n    \"DKK\": 6.563239,\n    \"DOP\": 58.536117,\n    \"DZD\": 133.603367,\n    \"EGP\": 49.7165,\n    \"ERN\": 15,\n    \"ETB\": 161.234364,\n    \"EUR\": 0.87803,\n    \"FJD\": 2.24285,\n    \"FKP\": 0.756883,\n    \"GBP\": 0.756883,\n    \"GEL\": 2.645,\n    \"GGP\": 0.756883,\n    \"GHS\": 11.225635,\n    \"GIP\": 0.756883,\n    \"GMD\": 73.000001,\n    \"GNF\": 8763.365726,\n    \"GTQ\": 7.629858,\n    \"GYD\": 209.231736,\n    \"HKD\": 7.84019,\n    \"HNL\": 26.757136,\n    \"HRK\": 6.615694,\n    \"HTG\": 130.756655,\n    \"HUF\": 311.301829,\n    \"IDR\": 17921.574628,\n    \"ILS\": 2.99591,\n    \"IMP\": 0.756883,\n    \"INR\": 94.731015,\n    \"IQD\": 1310.112797,\n    \"IRR\": 1375000,\n    \"ISK\": 126.44,\n    \"JEP\": 0.756883,\n    \"JMD\": 157.423792,\n    \"JOD\": 0.709,\n    \"JPY\": 161.5585,\n    \"KES\": 129.5,\n    \"KGS\": 87.45,\n    \"KHR\": 4014.11095,\n    \"KMF\": 431.000289,\n    \"KPW\": 900,\n    \"KRW\": 1536.15027,\n    \"KWD\": 0.30901,\n    \"KYD\": 0.833436,\n    \"KZT\": 488.630163,\n    \"LAK\": 22146.187109,\n    \"LBP\": 89561.536635,\n    \"LKR\": 334.602472,\n    \"LRD\": 182.011965,\n    \"LSL\": 16.491476,\n    \"LYD\": 6.417656,\n    \"MAD\": 9.360252,\n    \"MDL\": 17.60645,\n    \"MGA\": 4230,\n    \"MKD\": 54.118835,\n    \"MMK\": 2099.81,\n    \"MNT\": 3569.47,\n    \"MOP\": 8.07637,\n    \"MRU\": 39.722981,\n    \"MUR\": 47.959997,\n    \"MVR\": 15.46,\n    \"MWK\": 1734.149729,\n    \"MXN\": 17.475379,\n    \"MYR\": 4.1405,\n    \"MZN\": 63.899993,\n    \"NAD\": 16.491476,\n    \"NGN\": 1368.48,\n    \"NIO\": 36.798893,\n    \"NOK\": 9.785313,\n    \"NPR\": 151.500009,\n    \"NZD\": 1.762847,\n    \"OMR\": 0.384506,\n    \"PAB\": 1,\n    \"PEN\": 3.385322,\n    \"PGK\": 4.386042,\n    \"PHP\": 61.229001,\n    \"PKR\": 278.148101,\n    \"PLN\": 3.759767,\n    \"PYG\": 6096.52374,\n    \"QAR\": 3.645646,\n    \"RON\": 4.6075,\n    \"RSD\": 103.079,\n    \"RUB\": 74.549709,\n    \"RWF\": 1466.606761,\n    \"SAR\": 3.754292,\n    \"SBD\": 8.065041,\n    \"SCR\": 14.05647,\n    \"SDG\": 600.5,\n    \"SEK\": 9.70949,\n    \"SGD\": 1.296092,\n    \"SHP\": 0.756883,\n    \"SLE\": 24.75,\n    \"SLL\": 20969.5,\n    \"SOS\": 571.589275,\n    \"SRD\": 37.4305,\n    \"SSP\": 130.26,\n    \"STD\": 22281.8,\n    \"STN\": 21.491605,\n    \"SVC\": 8.751031,\n    \"SYP\": 13002,\n    \"SZL\": 16.486254,\n    \"THB\": 33.2,\n    \"TJS\": 9.275777,\n    \"TMT\": 3.51,\n    \"TND\": 2.960316,\n    \"TOP\": 2.40776,\n    \"TRY\": 46.480218,\n    \"TTD\": 6.79047,\n    \"TWD\": 31.6581,\n    \"TZS\": 2625.232,\n    \"UAH\": 44.892721,\n    \"UGX\": 3660.568506,\n    \"USD\": 1,\n    \"UYU\": 39.926274,\n    \"UZS\": 12015.771348,\n    \"VES\": 616.864713,\n    \"VND\": 26322.716504,\n    \"VUV\": 119.389,\n    \"WST\": 2.74422,\n    \"XAF\": 575.950051,\n    \"XAG\": 0.01615257,\n    \"XAU\": 0.0002431,\n    \"XCD\": 2.70255,\n    \"XCG\": 1.8024,\n    \"XDR\": 0.713895,\n    \"XOF\": 575.950051,\n    \"XPD\": 0.00080698,\n    \"XPF\": 104.776873,\n    \"XPT\": 0.00061182,\n    \"YER\": 238.649953,\n    \"ZAR\": 16.49239,\n    \"ZMW\": 17.940666,\n    \"ZWG\": 25.3626,\n    \"ZWL\": 322\n  }\n}', '2026-06-23', '10:05:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `currencie` varchar(3) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `currencie`, `amount`) VALUES
(6, 'Lennon', '$2y$10$phrDnXrnxjBDXd/a74v9s.PwzgfRfhXS/qfa6Q75QNZmZZtJWsXEe', 'lennonsfurtado@gmail.com', 'BRL', 1000);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `jsonscurrencies`
--
ALTER TABLE `jsonscurrencies`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT de tabela `jsonscurrencies`
--
ALTER TABLE `jsonscurrencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
