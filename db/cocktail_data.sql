-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2018 at 09:27 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocktail`
--

--
-- Dumping data for table `amounts`
--

INSERT INTO `amounts` (`idamounts`, `amount`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '1/2'),
(7, '1/3'),
(8, '2/3'),
(9, '1/4'),
(10, '3/4');

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idcategories`, `category_name`) VALUES
(1, 'Sweet'),
(2, 'Sour'),
(3, 'Bitter'),
(4, 'Spicey');

--
-- Dumping data for table `cocktails`
--

INSERT INTO `cocktails` (`idcocktails`, `fk_detail_id`, `fk_ingredient_id`, `fk_amounts_id`) VALUES
(4, 1, 3, 2),
(5, 1, 10, 1),
(6, 1, 5, 3),
(9, 3, 15, 4),
(10, 4, 12, 2),
(11, 5, 15, 3),
(12, 6, 15, 4),
(13, 7, 16, 2),
(14, 8, 16, 1),
(15, 9, 12, 3),
(16, 10, 12, 2),
(17, 11, 13, 1),
(18, 12, 11, 2),
(19, 13, 5, 2),
(20, 14, 1, 1),
(21, 15, 1, 1),
(22, 16, 1, 1),
(23, 2, 17, 1),
(24, 17, 16, 8),
(25, 18, 13, 5),
(26, 19, 1, 1),
(27, 20, 1, 1),
(28, 21, 16, 3),
(29, 22, 1, 1),
(30, 23, 1, 1),
(31, 25, 1, 1);

--
-- Dumping data for table `cocktail_details`
--

INSERT INTO `cocktail_details` (`idcoccktail_details`, `c_name`, `c_description`, `c_image`, `category`) VALUES
(1, 'Test Cocktail 2', 'This is a test cocktail', 'l_mandelmet.jpg', 1),
(2, 'Test Cocktail 3', 'This is sndkndjfnjkdsnfljksnf', 'placeholder.png', 1),
(3, 'Test Cocktail 4', 'jhasdijfbjkdsbfkljnsdkfl', 'l_tannenhonigmet.jpg', 4),
(4, 'Test Cocktail 5', 'sdkjfgjasbfjk', 'l_mandelmet.jpg', 1),
(5, 'Test Cocktail 6', 'skdgosadngojndsjog', 'placeholder.png', 4),
(6, 'Test Cocktail 7', 'dsmnnbÃ¶jlasndfkm dskmfkn s', 'placeholder.png', 1),
(7, 'Test Cocktail 8', 'skdnfsdnfj', 'placeholder.png', 2),
(8, 'Test Cocktail 9', 'klsdgojnsdjgknkn', 'placeholder.png', 1),
(9, 'Test Cocktail 10', 'lkfjgklnfslgkns', 'placeholder.png', 1),
(10, 'Test Cocktail 11', 'skjdbfkjsdknbf', 'l_gldans.jpg', 1),
(11, 'Test Cocktail 12', 'vnslknvksjdnvklsn', 'l_sweet.jpg', 3),
(12, 'Test Cocktail 13', 'lsmvlsmld', 'l_gldans.jpg', 4),
(13, 'Test Cocktail 14', 'sdjffkiwenifb', 'l_chili.jpg', 1),
(14, 'Test Cocktail 15', 'dkmds', 'l_tannenhonigmet.jpg', 2),
(15, 'Test Cocktail 16', 'njfj', 'l_herbal.jpg', 1),
(16, 'Test Cocktail 17', 'sldmvkmn', 'l_sweet.jpg', 3),
(17, 'kjhijgnksjdfgÃ¶dsfg', 'sldfbihasbdfjpasndfkjsa', 'l_tannenhonigmet.jpg', 1),
(18, 'nkgjndfkjgn', 'dfngkjdsbkfjgn', 'l_fass.jpg', 1),
(19, 'jkfbkjsdbnf', 'ssldvn', 'l_feige.jpg', 1),
(20, 'sd,mfbjkasdbfjk', 'kjjbdijfb', 'l_sweet.jpg', 1),
(21, 'ffmnrijgn', 'sklngiurhg', 'l_tannenhonigmet.jpg', 1),
(22, 'idhfgwe', 'ldhfiu', 'placeholder.png', 1),
(23, 'fbvkjnbgnk', 'sknfgio', 'l_herbal.jpg', 1),
(24, 'fgnjkdfgb', 'ngkjrbgkejr', 'placeholder.png', 1),
(25, 'dfgnk', 'skndbi', 'placeholder.png', 1);

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`idingredients`, `ingredient`) VALUES
(1, 'Sugar syrup'),
(2, 'Lime juice'),
(3, 'Lemon juice'),
(4, 'London dry gin'),
(5, 'Vodka'),
(6, 'Light white rum'),
(7, 'Angostura Aromatic Bitters'),
(8, 'Orange juice'),
(9, 'Tiple seq liqueur'),
(10, 'Dry vermounth'),
(11, 'Cognac V.S.O.p.'),
(12, 'Pinapple juice'),
(13, 'Pomegranate syrup'),
(14, 'Tequila (reposado)'),
(15, 'Egg white'),
(16, 'Orange bitters'),
(17, 'Cranberry juice');

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idlogin`, `username`, `password`) VALUES
(1, 'Bourbonkiid', '$1$I25igdPF$8K3WNE66Tr9ipYbrWOvms.'),
(2, 'TestUser', '$1$.VXv7sKK$9B1hB2jLuGBCJ42rwrkn60'),
(3, 'Administrator', '$1$vGXgiuoT$g2vUvC9Sj2G3aZkTXI6R81'),
(4, 'TheDrinker', '$1$wNJY8jnv$7ww/GnfZOvIfNBXN0VzhK1'),
(5, 'NiceDrinks', '$1$aClhUSIa$.7oohqzGyNATgDLwVCD6C0');

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`idrating`, `fk_cocktail`, `rating`, `fk_user`) VALUES
(1, 1, 4, 2),
(2, 1, 2, 2),
(3, 1, 4, 3),
(4, 5, 4, 3),
(5, 3, 3, 5),
(6, 8, 5, 5),
(7, 8, 2, 5),
(8, 8, 2, 5),
(9, 8, 2, 5),
(10, 8, 5, 5),
(11, 8, 5, 5),
(12, 8, 5, 5);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idrole`, `rolename`) VALUES
(1, 'Admin'),
(2, 'Guest');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `firstname`, `lastname`, `email`, `fk_login_id`, `role`) VALUES
(1, 'Steven', 'Ringger', 'bourbon.kiid@gmail.com', 1, 1),
(2, 'Test', 'User', 'test@user.com', 2, 2),
(3, 'Admini', 'Strator', 'admini@strator.com', 3, 1),
(4, 'Thomas', 'Abeln', 't.abeln@gmail.com', 4, 2),
(5, 'Zoe', 'Abeln', 'zabeln@gmail.com', 5, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
