-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 11, 2019 lúc 11:17 AM
-- Phiên bản máy phục vụ: 10.3.15-MariaDB
-- Phiên bản PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dlmh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking_tours`
--

CREATE TABLE `booking_tours` (
  `bt_id` int(10) UNSIGNED NOT NULL,
  `bt_num_child` int(255) NOT NULL,
  `bt_num_adult` int(11) NOT NULL,
  `bt_total_price` double NOT NULL,
  `bt_date` date NOT NULL,
  `bt_status` int(11) NOT NULL,
  `bt_user_client` int(11) UNSIGNED NOT NULL,
  `bt_tour` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `booking_tours`
--

INSERT INTO `booking_tours` (`bt_id`, `bt_num_child`, `bt_num_adult`, `bt_total_price`, `bt_date`, `bt_status`, `bt_user_client`, `bt_tour`, `created_at`, `updated_at`) VALUES
(4, 0, 1, 13600000, '2019-07-05', 2, 2, 2, '2019-07-04 21:19:32', '2019-07-04 21:19:32'),
(5, 0, 1, 13600000, '2019-07-05', 2, 2, 2, '2019-07-04 21:21:20', '2019-07-04 21:21:20'),
(6, 0, 1, 18000000, '2019-07-07', 1, 2, 1, '2019-07-07 05:38:12', '2019-07-07 05:38:12'),
(7, 1, 1, 18000000, '2019-07-07', 1, 2, 1, '2019-07-07 13:51:31', '2019-07-07 13:51:31'),
(8, 2, 2, 8000000, '2019-07-02', 1, 2, 9, NULL, NULL),
(9, 1, 1, 4200000, '2019-07-01', 1, 1, 9, NULL, NULL),
(10, 0, 1, 6800000, '2019-07-03', 2, 2, 4, NULL, NULL);

--
-- Bẫy `booking_tours`
--
DELIMITER $$
CREATE TRIGGER `insert_bookingtours` AFTER INSERT ON `booking_tours` FOR EACH ROW BEGIN
	DECLARE songuoi int;
	DECLARE tongtien double;
	IF (NEW.bt_status=1) THEN
		SELECT tour_slot_book INTO songuoi FROM tours WHERE tour_id = NEW.bt_tour;
        SELECT tour_total_fare INTO tongtien FROM tours WHERE tour_id = NEW.bt_tour;
        SET tongtien = tongtien + NEW.bt_total_price;
		SET songuoi = songuoi + NEW.bt_num_adult + NEW.bt_num_child;
		UPDATE tours SET tours.tour_slot_book = songuoi, tours.tour_total_fare = tongtien WHERE tours.tour_id = NEW.bt_tour;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_bookingtours_before` BEFORE INSERT ON `booking_tours` FOR EACH ROW BEGIN
	DECLARE giatour double;
    
    SELECT tour_price INTO giatour FROM tours WHERE tour_id = NEW.bt_tour;
    SET NEW.bt_total_price = giatour*NEW.bt_num_adult + (giatour/2)*NEW.bt_num_child;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_bookingtours` AFTER UPDATE ON `booking_tours` FOR EACH ROW BEGIN
	DECLARE songuoi int;
	DECLARE tongtien double;
	IF (NEW.bt_status=1) THEN
		SELECT tour_slot_book INTO songuoi FROM tours WHERE tour_id = NEW.bt_tour;
        SELECT tour_total_fare INTO tongtien FROM tours WHERE tour_id = NEW.bt_tour;
        SET tongtien = tongtien + NEW.bt_total_price;
		SET songuoi = songuoi + NEW.bt_num_adult + NEW.bt_num_child;
		UPDATE tours SET tours.tour_slot_book = songuoi, tours.tour_total_fare = tongtien WHERE tours.tour_id = NEW.bt_tour;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(10) UNSIGNED NOT NULL,
  `cate_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cate_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `cate_image`, `created_at`, `updated_at`) VALUES
(2, 'Nhảy dù', '1561535871.jpeg', '2019-06-26 07:57:52', '2019-06-26 07:57:52'),
(3, 'Lặn biển', '1561535892.jpeg', '2019-06-26 07:58:12', '2019-06-26 07:58:12'),
(4, 'Leo núi', '1561537121.jpeg', '2019-06-26 08:18:41', '2019-06-26 08:18:41'),
(5, 'Khám phá hang động', '1561537148.jpeg', '2019-06-26 08:19:08', '2019-06-26 08:19:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `destinations`
--

CREATE TABLE `destinations` (
  `dest_id` int(10) UNSIGNED NOT NULL,
  `dest_tourist_route` int(11) UNSIGNED NOT NULL,
  `dest_location` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `destinations`
--

INSERT INTO `destinations` (`dest_id`, `dest_tourist_route`, `dest_location`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, 2, 5, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(3, 2, 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(4, 2, 6, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(5, 2, 1, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(36, 3, 6, '2019-07-08 15:28:27', '2019-07-08 15:28:27'),
(37, 3, 2, '2019-07-08 15:28:27', '2019-07-08 15:28:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite_tours`
--

CREATE TABLE `favorite_tours` (
  `fa_id` int(10) UNSIGNED NOT NULL,
  `fa_user_client` int(11) UNSIGNED NOT NULL,
  `fa_tour` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_news`
--

CREATE TABLE `image_news` (
  `in_id` int(10) UNSIGNED NOT NULL,
  `in_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `in_news` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_tourist_routes`
--

CREATE TABLE `image_tourist_routes` (
  `itr_id` int(10) UNSIGNED NOT NULL,
  `itr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `itr_tourist_route` int(10) UNSIGNED NOT NULL,
  `itr_highlight` tinyint(1) NOT NULL,
  `itr_default` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image_tourist_routes`
--

INSERT INTO `image_tourist_routes` (`itr_id`, `itr_name`, `itr_tourist_route`, `itr_highlight`, `itr_default`, `created_at`, `updated_at`) VALUES
(1, '156172601915617260194155.jpeg', 1, 1, 1, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, '156172601915617260195336.jpeg', 1, 0, 0, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(3, '156172601915617260196150.jpeg', 1, 0, 0, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(4, '156178231615617823161738.jpeg', 3, 1, 1, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(5, '156178231615617823163112.jpeg', 3, 0, 0, '2019-06-29 04:25:16', '2019-06-29 04:25:16'),
(6, '156178231615617823164663.jpeg', 3, 0, 0, '2019-06-29 04:25:16', '2019-06-29 04:25:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locations`
--

CREATE TABLE `locations` (
  `loca_id` int(10) UNSIGNED NOT NULL,
  `loca_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loca_description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `loca_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `locations`
--

INSERT INTO `locations` (`loca_id`, `loca_name`, `loca_description`, `loca_poster`, `created_at`, `updated_at`) VALUES
(1, 'Lào Cai', 'Việt Nam', '1561546084.jpeg', '2019-06-26 10:48:04', '2019-06-26 10:48:04'),
(2, 'Điện Biên Phủ', 'Việt Nam', '1561546123.jpeg', '2019-06-26 10:48:43', '2019-06-26 10:48:43'),
(4, 'Lai Châu', 'Việt Nam', '1561546429.jpeg', '2019-06-26 10:49:48', '2019-06-26 10:53:49'),
(5, 'Gia Lai', 'Việt Nam', '1561546453.jpeg', '2019-06-26 10:54:13', '2019-06-26 10:54:13'),
(6, 'Cần Thơ', 'Việt Nam', '1561546476.jpeg', '2019-06-26 10:54:36', '2019-06-26 10:54:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_06_24_193644_create_tours_table', 2),
(9, '2019_06_24_193748_create_destinations_table', 2),
(10, '2019_06_24_193838_create_locations_table', 2),
(11, '2019_06_24_194036_create_tourist_route_details_table', 2),
(12, '2019_06_24_194436_create_categories_table', 2),
(13, '2019_06_24_194636_create_tourist_routes_table', 2),
(14, '2019_06_24_194750_create_reviews_table', 2),
(15, '2019_06_24_200852_create_booking_tours_table', 2),
(16, '2019_06_24_201743_create_favorite_tours_table', 2),
(17, '2019_06_24_201900_create_image_tourist_routes_table', 2),
(18, '2019_06_24_202012_create_news_table', 2),
(19, '2019_06_24_202101_create_user_clients_table', 2),
(20, '2019_06_24_214743_create_image_news_table', 2),
(21, '2019_06_24_222828_create_promotions_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `news_id` int(10) UNSIGNED NOT NULL,
  `news_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `news_time_post` date NOT NULL,
  `news_user_admin` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_description`, `news_poster`, `news_content`, `news_time_post`, `news_user_admin`, `created_at`, `updated_at`) VALUES
(2, 'Trải nghiệm Công viên nước \"Nằm trên lưng đồi\" tại KDL Núi Thần Tài', 'Với diện tích rộng lên đến 1532m2 cùng hàng loạt trò chơi dưới nước vui nhộn...', '1562267326.jpeg', '<p>Cách thành phố Đà Nẵng 30km về phía Tây, CVSKN Núi Thần Tài được biết đến là khu vui chơi,&nbsp; nghỉ dưỡng phức hợp mang đậm phong cách thiên nhiên hùng vĩ với nét kiến trúc độc đáo nằm ẩn hiện giữa một màu xanh ngắt của núi rừng. Nơi đây đã trở thành địa điểm vui chơi quen thuộc của người dân Đà thành cũng như du khách khi đến với thành phố biển xinh đẹp.</p>', '2019-07-05', 1, '2019-07-04 19:08:46', '2019-07-04 19:09:52'),
(3, 'Khám phá hòn Đá Bạc ở Cà Mau', 'Đoạn đường dài hơn 80km từ thành phố Cà Mau về đến xã Khánh Bình Tây (thuộc huyện Trần Văn Thời, tỉnh Cà Mau)', '1562267490.jpeg', '<p>Nối liền vàm Đá Bạc của xã Khánh Bình Tây với hòn Đá Bạc nằm chơ vơ ngoài biển bây giờ là một cây cầu đúc bằng xi măng có 2 làn đường &nbsp;cùng hệ thống đèn điện thẳng tắp dài hơn 1.000m rất kiên cố và không kém phần hoành tráng. Ít ai biết, trước đây hòn Đá Bạc nằm cách xa bờ xã Khánh Bình Tây đến hơn 4,2km; người dân huyện Trần Văn Thời muốn ra ngoài hòn phải có tàu, ghe. Những năm gần đây, vàm Đá Bạc được bồi tụ, lấn dần ra biển hình thành thêm một ấp chài mới, níu gần ra hòn Đá Bạc.</p><p>Với diện tích không lớn lắm, chỉ 6,34ha, hòn Đá Bạc bao gồm: hòn Ông Ngộ, hòn Sân Tiên và Đá Bạc với đỉnh nhô cao nhất lên đến 22,7m được bao phủ bởi thảm thực vật xanh tươi quanh năm và được “bọc lót” chung quanh bởi những tảng đá khổng lồ kê san sát bên nhau tạo ra nhiều khe nước trong xanh thu hút các loài rong rêu, cá, hàu, tôm, cua… sinh sống; tạo nên một vùng sinh cảnh khá là hấp dẫn.</p><p>Xác định hòn Đá Bạc là điểm du lịch sinh thái, văn hóa và lịch sử, ngành thương mại và du lịch tỉnh Cà Mau đã đầu tư xây dựng trên hòn một khách sạn, nhà hàng rất bề thế, đặc biệt là thiết kế xây dựng một cặp rồng khổng lồ bằng xi măng cốt sắt rất uy nghi, hoành tráng đang trườn mình qua dãy Yên Ngựa nối liền hòn Sân Tiên với hòn Đá Bạc. Để việc đi vào Khu du lịch Hòn Đá Bạc được thuận tiện, dễ dàng; một chiếc cầu xi măng dài gần 2.000m được xây dựng đã nối liền vàm Đá Bạc với hòn Đá Bạc tạo thành con đường trên biển lồng lộng gió, thu hút nam thanh nữ tú các nơi đi xe gắn máy ra tận ngoài hòn ngao du, thưởng lãm. Cây cầu đầu tiên “nối hai bờ vui” này đã bị cơn bão số 5 (năm 1997) đổ bộ vào Cà Mau đánh gãy sập thành nhiều khúc. Nay trên hòn vẫn còn giữ lại mấy khúc cầu đã gãy lại để làm “nhân chứng thiên tai”. Tuy nhiên, ngay sau sự cố cây cầu bị sập, Cà Mau&nbsp; nhanh chóng xây lại cây cầu mới kiên cố, đẹp đẽ hơn để “ welcome” du khách bốn phương.</p><p>Hấp dẫn dân sành điệu là nguồn hải sản tươi sống và rất phong phú được đánh bắt quanh hòn Đá Bạc; trong đó hàu là sản vật ngon của vùng biển này từng được hai tác giả Nghê Văn Lương và Huỳnh Minh đưa vào cuốn sách sưu khảo “Cà Mau xưa”.</p><p>Theo quy hoạch, hòn Đá Bạc sẽ bao gồm: khu dịch vụ du lịch, khu tưởng niệm (để nhớ đến những người đã khuất trong cơn bão lịch sử số 5), khu vực bia chiến thắng (Chuyên án CM12 và địa điểm bố trí 2 khẩu pháo 105 ly của quân Mỹ nguỵ nhằm khống chế toàn bộ vùng biển Tây Cà Mau trước năm 1975), nhà trưng bày, giới thiệu đặc điểm tự nhiên, lịch sử hình thành cùng các truyền thuyết về dấu Chân Tiên, Hang Hòn… Khai thác đặc điểm tự nhiên cùng các di tích lịch sử, văn hóa, hòn Đá Bạc còn liên kết với Vồ Dơi - đầm Thị Trường - mũi Cà Mau hình thành tuyến du lịch xanh khá độc đáo của miền cực Nam Tổ quốc. &nbsp;</p>', '2019-07-05', 1, '2019-07-04 19:11:30', '2019-07-04 19:11:30'),
(4, 'Khám phá những viên ngọc vùng Đông Âu', 'Đông Âu là vùng đất có lịch sử nhiều thăng trầm, sở hữu di sản văn hóa, cảnh quan đa dạng…', '1562267551.jpeg', '<p>Rất ít thành phố nào trên thế giới có được nét đẹp duyên dáng, lãng mạn như Venice, nơi được mệnh danh là thiên đường tình yêu của châu Âu. Ngồi trên thuyền đi qua những con kênh đào dày đặc, những cây cầu nổi tiếng mang tên cầu Than Thở, cầu Rialto là trải nghiệm đáng nhớ mà ai cũng phải thử một lần khi đã đặt chân đến Venice.</p><p>Venice còn hấp dẫn du khách bởi chất cổ điển được lưu giữ nguyên vẹn từ hàng trăm năm với khu phố cổ tuyệt đẹp phủ màu gạch đỏ truyền thống của vùng Địa Trung Hải, quảng trường thánh Marco <strong>-</strong> quảng trường quan trọng nhất, nổi tiếng nhất và đồng thời là trung tâm của Venice.&nbsp;Nơi đây từng được Napoléon gọi là&nbsp;“phòng khách của châu Âu” bởi kiến trúc tuyệt mỹ.</p>', '2019-07-05', 1, '2019-07-04 19:12:31', '2019-07-04 19:12:31'),
(5, 'Hồ Đa Tôn - điểm du lịch sinh thái hấp dẫn tại Đồng Nai', 'goài khu du lịch Vườn Quốc gia Nam Cát Tiên, công viên Suối Mơ (huyện Tân Phú, Đồng Nai)', '1562267614.jpeg', '<p>Chính vì sở hữu khung cảnh hữu tình từ sự hào quyện giữa màu xanh của núi đồi và sắc xanh của mặt hồ và nét chấm phá của ánh nắng mặt trời lúc bình minh lên hay hoàng hôn xuống đã tạo nên cho hồ Đa Tôn một khu cảnh thiên nhiên tuyệt đẹp và được xem là viên ngọc bích giữa núi rừng đã làm say lòng biết bao du khách khi đặt chân đến nơi này.</p><p>Bỏ lại những lo toan bộn bề của cuộc sống thường nhật để tìm đến hồ Đa Tôn, du khách sẽ dần dần bị chinh phục bởi nét đẹp tinh tế bởi sự giao hoà giữa cảnh vật thiên nhiên nơi đây.</p><p>Đến đây, để chiêm ngưỡng vẻ đẹp của hồ Đa Tôn du khách có thể đi thuyền máy trên sông lúc bình minh vừa bắt đầu hé lên hay lúc chiều tà để tận hưởng được những khung cảnh thiên nhiên tuyệt vời nhất.</p>', '2019-07-05', 1, '2019-07-04 19:13:34', '2019-07-04 19:13:34'),
(6, 'Thăm Quảng Châu – nhớ Bác', 'Những ngày đầu khi đến Quảng Châu, Bác ở trong trụ sở của phái đoàn cố vấn Liên Xô', '1562267669.jpeg', '<p>Có thể nói đây là cái nôi, là nơi tập họp và đào tạo nên những người lãnh đạo cách mạng đầu tiên của Việt Nam như Trần Phú, Lê Hồng Phong, Phạm Văn Đồng, Nguyễn Lương Bằng, Phan Trọng Bình, Lê Thiết Hùng… Tổ chức Việt Nam Thanh niên Cách mạng đồng chí Hội từ đây lan tỏa về Việt Nam, có cơ sở ở khắp ba miền Trung, Nam, Bắc và cả trong lực lượng Việt kiều ở Thái Lan. Hội có quan hệ với Đảng Cộng sản Trung Quốc, Đảng Cộng sản Pháp và Quốc tế Cộng sản. Bác cũng chọn lọc những người ưu tú để cử đi học Đại học Phương Đông Liên Xô và vào học Trường quân sự Hoàng Phố (do Chu Ân Lai và Diệp Kiếm Anh phụ trách) nhằm chuẩn bị lực lượng nòng cốt cho Đảng và cho công tác quân sự sau này như: Trần Phú, Lê Hồng Phong, Bùi Công Trừng, Phùng Chí Kiên, Nguyễn Sơn, Lê Quảng Đạt, Lê Thiết Hùng…&nbsp;</p><figure class=\"image image-style-side\"><img src=\"http://localhost:8000/userfiles/images/langbiang4.jpg\"></figure><p>Cũng tại đây, Bác cho ra đời tờ báo “Thanh Niên”, mỗi tuần ra một số bằng cách in Ronéo, trên trang nhất luôn có hình ngôi sao năm cánh bên cạnh tít báo bằng chữ Việt và chữ Hán. Số báo đầu tiên ra ngày 21 tháng 6 năm 1925 và ra được 88 số. Báo Thanh Niên chính là tiền thân sớm nhất của báo chí cách mạng Việt Nam ngày nay lấy ngày 21 tháng 6 làm ngày báo chí Việt Nam cũng bắt nguồn từ đây. Bác đã tập hợp các bài giảng cho các lớp học và các bài báo để tu chỉnh thành cuốn sách giáo khoa cách mạng đầu tiên mang tên “Đường Kách Mệnh” (Đường Cách mạng). Năm 1927, sách được xuất bản công khai. Cũng tại Quảng Châu, Người đã vận động thành lập Hội liên hiệp các dân tộc bị áp bức gồm các nước Việt Nam, Trung Quốc, Triều Tiên, Ấn Độ, Indonesia và Myanmar. Bác là người viết tuyên ngôn, trong đó có câu: “Chúng ta nên sớm đoàn kết lại, hãy hợp lực để đòi quyền lợi và tự do của chúng ta! Hãy hợp lực để cứu lấy nòi giống của chúng ta”. Chính từ các hoạt động này đã giúp Bác nhanh chóng quyết định hợp nhất các tổ chức Đảng ở Việt Nam, để ngày 3 tháng 2 năm 1930 (tức ngày 6 tháng 1 âm lịch) thành lập nên Đảng Cộng sản Việt Nam, chính đảng đầu tiên của cách mạng Việt Nam.</p>', '2019-07-05', 1, '2019-07-04 19:14:29', '2019-07-06 03:46:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `prom_id` int(10) UNSIGNED NOT NULL,
  `prom_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prom_description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `prom_percent_promotion` int(11) NOT NULL,
  `prom_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`prom_id`, `prom_name`, `prom_description`, `prom_percent_promotion`, `prom_banner`, `created_at`, `updated_at`) VALUES
(1, 'Chào mừng hè', 'Hè tới rồi đi du lịch thôi bạn ơi', 15, '1561819077.jpeg', '2019-06-29 14:37:57', '2019-06-29 14:37:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `revenues`
--

CREATE TABLE `revenues` (
  `reve_id` int(11) NOT NULL,
  `reve_month` int(11) NOT NULL,
  `reve_quarter` int(11) DEFAULT NULL,
  `reve_year` int(11) NOT NULL,
  `reve_cost` double NOT NULL,
  `reve_total_fare` double NOT NULL,
  `reve_income` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `revenues`
--

INSERT INTO `revenues` (`reve_id`, `reve_month`, `reve_quarter`, `reve_year`, `reve_cost`, `reve_total_fare`, `reve_income`, `created_at`, `updated_at`) VALUES
(1, 9, 3, 2019, 140000000, 248000000, 108000000, NULL, NULL),
(2, 7, 3, 2019, 50000000, 18000000, -32000000, NULL, NULL);

--
-- Bẫy `revenues`
--
DELIMITER $$
CREATE TRIGGER `insert_revenue` BEFORE INSERT ON `revenues` FOR EACH ROW BEGIN
	SET NEW.reve_income = NEW.reve_total_fare - NEW.reve_cost;
    IF( NEW.reve_month >= 1 AND NEW.reve_month <=3) THEN
    	SET NEW.reve_quarter = 1;
    ELSEIF (NEW.reve_month >= 4 AND NEW.reve_month <=6) THEN
    	SET NEW.reve_quarter = 2;
    ELSEIF (NEW.reve_month >= 7 AND NEW.reve_month <=9) THEN
    	SET NEW.reve_quarter = 3;
    ELSE
    	SET NEW.reve_quarter = 4;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_revenue` BEFORE UPDATE ON `revenues` FOR EACH ROW BEGIN
    SET NEW.reve_income = NEW.reve_total_fare - NEW.reve_cost;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `revi_id` int(10) UNSIGNED NOT NULL,
  `revi_star` int(11) NOT NULL,
  `revi_content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revi_time` datetime NOT NULL,
  `revi_tourist_route` int(11) UNSIGNED NOT NULL,
  `revi_user_client` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`revi_id`, `revi_star`, `revi_content`, `revi_time`, `revi_tourist_route`, `revi_user_client`, `created_at`, `updated_at`) VALUES
(1, 4, 'Tour này thật tuyệt vời :))', '2019-06-29 08:21:23', 1, 1, '2019-06-28 17:00:00', '2019-06-28 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tourist_routes`
--

CREATE TABLE `tourist_routes` (
  `tr_id` int(10) UNSIGNED NOT NULL,
  `tr_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_category` int(11) UNSIGNED NOT NULL,
  `tr_introduction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_time` int(11) NOT NULL,
  `tr_original_price` double NOT NULL,
  `tr_max_slot` int(11) NOT NULL,
  `tr_poster` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tr_location` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tourist_routes`
--

INSERT INTO `tourist_routes` (`tr_id`, `tr_name`, `tr_category`, `tr_introduction`, `tr_time`, `tr_original_price`, `tr_max_slot`, `tr_poster`, `tr_location`, `created_at`, `updated_at`) VALUES
(1, 'Chèo đèo', 2, 'haha', 2, 8000000, 2, '1561726019.jpeg', 2, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, 'Nhày dù', 3, '', 2, 21000000, 2, '1561738745.jpeg', 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(3, 'Vượt thác', 4, '', 3, 18000000, 10, '1561782315.jpeg', 1, '2019-06-29 04:25:15', '2019-07-08 15:28:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tourist_route_details`
--

CREATE TABLE `tourist_route_details` (
  `trd_id` int(10) UNSIGNED NOT NULL,
  `trd_date` int(11) NOT NULL,
  `trd_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trd_description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `trd_tourist_route` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tourist_route_details`
--

INSERT INTO `tourist_route_details` (`trd_id`, `trd_date`, `trd_title`, `trd_description`, `trd_tourist_route`, `created_at`, `updated_at`) VALUES
(1, 1, '', 'Leo núi mệt quá', 1, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(2, 2, '', 'Chán đời thôi', 1, '2019-06-28 12:46:59', '2019-06-28 12:46:59'),
(3, 1, '', 'lễ', 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(4, 2, '', 'lộc', 2, '2019-06-28 16:19:08', '2019-06-28 16:19:08'),
(23, 1, 'hi', 'Vui chơi cả ngày', 3, '2019-07-08 15:28:27', '2019-07-08 15:28:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `tour_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tour_time_start` date NOT NULL,
  `tour_time_finish` date DEFAULT NULL,
  `tour_slot_book` int(11) DEFAULT 0,
  `tour_price` double NOT NULL,
  `tour_tourist_route` int(10) UNSIGNED NOT NULL,
  `tour_promotion` int(11) DEFAULT 0,
  `tour_total_fare` double DEFAULT 0,
  `tour_cost` double DEFAULT 0,
  `tour_status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`tour_id`, `tour_code`, `tour_time_start`, `tour_time_finish`, `tour_slot_book`, `tour_price`, `tour_tourist_route`, `tour_promotion`, `tour_total_fare`, `tour_cost`, `tour_status`, `created_at`, `updated_at`) VALUES
(1, '120190822', '2019-07-10', NULL, 4, 18000000, 3, 0, 18000000, 50000000, 3, '2019-07-01 04:16:33', '2019-07-08 16:09:43'),
(2, '120190925', '2019-09-20', NULL, 2, 6800000, 1, 1, 68000000, 40000000, 3, '2019-07-01 04:16:33', '2019-07-01 06:51:53'),
(3, '120191211', '2019-09-20', NULL, 0, 18000000, 3, 0, 180000000, 100000000, 3, '2019-07-01 04:16:33', '2019-07-01 04:16:33'),
(4, '120200108', '2020-01-08', NULL, 0, 21000000, 2, 0, 0, 0, 0, '2019-07-01 04:16:33', '2019-07-01 04:16:33'),
(9, '120516492', '2019-07-14', '2019-07-16', 6, 2800000, 2, 0, 12200000, 0, 0, NULL, NULL);

--
-- Bẫy `tours`
--
DELIMITER $$
CREATE TRIGGER `insert_tours` BEFORE INSERT ON `tours` FOR EACH ROW BEGIN
DECLARE songay int;
SELECT tourist_routes.tr_time into songay FROM tourist_routes WHERE tourist_routes.tr_id= NEW.tour_tourist_route;
SET NEW.tour_time_finish = DATE_ADD(NEW.tour_time_start,INTERVAL songay DAY);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tours_revenue` AFTER UPDATE ON `tours` FOR EACH ROW BEGIN
DECLARE flag int;
DECLARE month int;
DECLARE year int;
DECLARE tienthu double;
DECLARE tienchi double;
IF (NEW.tour_status = 3) THEN
	SET year = year(New.tour_time_start), month = month(New.tour_time_start);
    SELECT COUNT(*) INTO flag FROM revenue WHERE revenue.reve_year = year AND revenue.reve_month = month;
    	IF(flag = 0) THEN
    	BEGIN
			SET tienthu = NEW.tour_total_fare;
        	SET tienchi = NEW.tour_cost;
    		INSERT INTO `revenue`(`reve_month`, `reve_year`, `reve_cost`, `reve_total_fare`) VALUES (month, year, tienchi, tienthu); 
    	END;
    	ELSE
    	BEGIN
    		SELECT revenue.reve_cost INTO tienchi FROM revenue WHERE revenue.reve_year = year AND revenue.reve_month = month;
        	SELECT revenue.reve_total_fare INTO tienthu FROM revenue WHERE revenue.reve_year = year AND revenue.reve_month = month;
        
        	SET tienthu = tienthu + NEW.tour_total_fare;
        	SET tienchi = tienchi + NEW.tour_cost;
        	UPDATE revenue SET revenue.reve_cost = tienchi WHERE revenue.reve_year = year AND revenue.reve_month = month;
            UPDATE revenue SET revenue.reve_total_fare = tienthu WHERE revenue.reve_year = year AND revenue.reve_month = month;
    	END;
    END IF;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `bio` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile.png',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `bio`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Minh Anh', 'admin@me.com', NULL, '$2y$10$4A2amIGywuzvJTG5GVO/Ke48QYIUzk94CeztmzHXy7aYfMV0RzvGy', 'admin', NULL, 'profile.png', 'bpHXEqHtW4E9Dl0bWK388Ulqisv2Zl4clZnrnyNb8CA5x1c4jtwm7MJdsxE5', '2019-06-23 12:13:05', '2019-06-25 18:01:18'),
(2, 'thang thai', 'thanglong2098@gmail.com', NULL, '$2y$10$4A2amIGywuzvJTG5GVO/Ke48QYIUzk94CeztmzHXy7aYfMV0RzvGy', 'admin', NULL, 'profile.png', NULL, '2019-06-25 10:05:18', '2019-06-25 10:05:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_clients`
--

CREATE TABLE `user_clients` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_gender` tinyint(1) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_clients`
--

INSERT INTO `user_clients` (`user_id`, `user_name`, `email`, `password`, `user_phone`, `user_gender`, `user_birthday`, `user_address`, `created_at`, `updated_at`) VALUES
(1, 'Hồ Thái Thăng', 'thanglong2098@gmail.com', '', '0147258369', 1, '1998-04-25', 'Ho Chi Minh City', '2019-06-28 17:00:00', '2019-06-28 17:00:00'),
(2, 'Nguyễn Minh Anh', 'admin@me.com', '$2y$10$Rh6hFQ0Sv2wUYjm/6SzB5eFFFvUKuuMxN7ss7Nb.C6gI/SKe.6mjy', '0968775364', 0, '1998-05-10', 'KTX khu A Đại học quốc gia TPHCM', '2019-07-04 18:33:01', '2019-07-04 20:25:48');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `booking_tours`
--
ALTER TABLE `booking_tours`
  ADD PRIMARY KEY (`bt_id`),
  ADD KEY `bt_tour` (`bt_tour`),
  ADD KEY `bt_user_client` (`bt_user_client`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`dest_id`),
  ADD KEY `dest_location` (`dest_location`),
  ADD KEY `dest_tourist_route` (`dest_tourist_route`);

--
-- Chỉ mục cho bảng `favorite_tours`
--
ALTER TABLE `favorite_tours`
  ADD PRIMARY KEY (`fa_id`);

--
-- Chỉ mục cho bảng `image_news`
--
ALTER TABLE `image_news`
  ADD PRIMARY KEY (`in_id`),
  ADD KEY `in_news` (`in_news`);

--
-- Chỉ mục cho bảng `image_tourist_routes`
--
ALTER TABLE `image_tourist_routes`
  ADD PRIMARY KEY (`itr_id`),
  ADD KEY `itr_tourist_route` (`itr_tourist_route`);

--
-- Chỉ mục cho bảng `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`loca_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `news_user_admin` (`news_user_admin`);

--
-- Chỉ mục cho bảng `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Chỉ mục cho bảng `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`prom_id`);

--
-- Chỉ mục cho bảng `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`reve_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`revi_id`),
  ADD KEY `revi_tourist_route` (`revi_tourist_route`),
  ADD KEY `revi_user_client` (`revi_user_client`);

--
-- Chỉ mục cho bảng `tourist_routes`
--
ALTER TABLE `tourist_routes`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `tr_location` (`tr_location`),
  ADD KEY `tr_category` (`tr_category`);

--
-- Chỉ mục cho bảng `tourist_route_details`
--
ALTER TABLE `tourist_route_details`
  ADD PRIMARY KEY (`trd_id`),
  ADD KEY `trd_tourist_route` (`trd_tourist_route`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`tour_id`),
  ADD UNIQUE KEY `tour_code` (`tour_code`),
  ADD KEY `tour_tourist_route` (`tour_tourist_route`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_clients`
--
ALTER TABLE `user_clients`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_clients_user_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `booking_tours`
--
ALTER TABLE `booking_tours`
  MODIFY `bt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `destinations`
--
ALTER TABLE `destinations`
  MODIFY `dest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `favorite_tours`
--
ALTER TABLE `favorite_tours`
  MODIFY `fa_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `image_news`
--
ALTER TABLE `image_news`
  MODIFY `in_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `image_tourist_routes`
--
ALTER TABLE `image_tourist_routes`
  MODIFY `itr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `locations`
--
ALTER TABLE `locations`
  MODIFY `loca_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `prom_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `revenues`
--
ALTER TABLE `revenues`
  MODIFY `reve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `revi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tourist_routes`
--
ALTER TABLE `tourist_routes`
  MODIFY `tr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tourist_route_details`
--
ALTER TABLE `tourist_route_details`
  MODIFY `trd_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user_clients`
--
ALTER TABLE `user_clients`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `booking_tours`
--
ALTER TABLE `booking_tours`
  ADD CONSTRAINT `booking_tours_ibfk_1` FOREIGN KEY (`bt_tour`) REFERENCES `tours` (`tour_id`),
  ADD CONSTRAINT `booking_tours_ibfk_2` FOREIGN KEY (`bt_user_client`) REFERENCES `user_clients` (`user_id`);

--
-- Các ràng buộc cho bảng `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`dest_location`) REFERENCES `locations` (`loca_id`),
  ADD CONSTRAINT `destinations_ibfk_2` FOREIGN KEY (`dest_tourist_route`) REFERENCES `tourist_routes` (`tr_id`);

--
-- Các ràng buộc cho bảng `image_news`
--
ALTER TABLE `image_news`
  ADD CONSTRAINT `image_news_ibfk_1` FOREIGN KEY (`in_news`) REFERENCES `news` (`news_id`);

--
-- Các ràng buộc cho bảng `image_tourist_routes`
--
ALTER TABLE `image_tourist_routes`
  ADD CONSTRAINT `image_tourist_routes_ibfk_1` FOREIGN KEY (`itr_tourist_route`) REFERENCES `tourist_routes` (`tr_id`);

--
-- Các ràng buộc cho bảng `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`news_user_admin`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`revi_tourist_route`) REFERENCES `tourist_routes` (`tr_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`revi_user_client`) REFERENCES `user_clients` (`user_id`);

--
-- Các ràng buộc cho bảng `tourist_routes`
--
ALTER TABLE `tourist_routes`
  ADD CONSTRAINT `tourist_routes_ibfk_1` FOREIGN KEY (`tr_location`) REFERENCES `locations` (`loca_id`),
  ADD CONSTRAINT `tourist_routes_ibfk_2` FOREIGN KEY (`tr_category`) REFERENCES `categories` (`cate_id`);

--
-- Các ràng buộc cho bảng `tourist_route_details`
--
ALTER TABLE `tourist_route_details`
  ADD CONSTRAINT `tourist_route_details_ibfk_1` FOREIGN KEY (`trd_tourist_route`) REFERENCES `tourist_routes` (`tr_id`);

--
-- Các ràng buộc cho bảng `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`tour_tourist_route`) REFERENCES `tourist_routes` (`tr_id`);

DELIMITER $$
--
-- Sự kiện
--
CREATE DEFINER=`root`@`localhost` EVENT `UpdateTourStatus` ON SCHEDULE EVERY 1 DAY STARTS '2019-04-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
UPDATE tours SET tours.tour_status = 1 WHERE tours.tour_time_start - now()=2;
UPDATE tours SET tours.tour_status = 2 WHERE tours.tour_time_finish < now();
END$$

CREATE DEFINER=`root`@`localhost` EVENT `UpdateBookingStatus` ON SCHEDULE EVERY 1 DAY STARTS '2019-04-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DECLARE done INT DEFAULT 0;
DECLARE matour INT;
DECLARE tinhtrangtour_cursor CURSOR FOR
    	SELECT tour_id
		FROM tours
		WHERE tour_status = 1;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1; 
	
    OPEN tinhtrangtour_cursor;
		read_loop: LOOP
		FETCH tinhtrangtour_cursor INTO matour;
		IF done THEN
		LEAVE read_loop;
		END IF;
		UPDATE booking_tours SET booking_tours.bt_status = 2 WHERE booking_tours.bt_tour = matour AND booking_tours.bt_status = 0;
		END LOOP;
	CLOSE tinhtrangtour_cursor;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
