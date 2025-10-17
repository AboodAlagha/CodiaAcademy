-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 10:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codia_academy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `image`) VALUES
(28, 'من نحن', 'تغيير التعلم للأفضل سواء كنت تريد أن تتعلم أو تطوير ما تعرفه ، فقد وصلت إلى المكان الصحيح. كوجهة للتعلم عبر الإنترنت ، نحن نربط الناس من خلال إرادة المعرفة. مجموعة من المدربين الخبراء في المجالات التقنية الحديثة يريدون نشر العلم و الخبرة العملية للناس عن طريق دورات متخصصة من الصفر للاحتراف ، حيث لا يجب عليك أن يكون لديك معرفة كبيرة بالمجال قبل المشاركة معنا.', 'img1672776656.png');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`id`, `title`, `description`, `image`) VALUES
(5, 'اكتشف', 'مجموعة كبيرة ومتنوعة من أكثر الدورات والتخصصات كفاءة وجودة.', 'img1672776757.svg'),
(6, 'التحق', 'بأحد البرامج لتنضمّ إلى مجتمع من المتعلّمين الرّاغبين بالتطوّر، مثلك تمامًا.\r\n', 'img1672776771.svg'),
(7, 'تعلّم', 'مع أكثر المدرّبين كفاءة لتصقل مهاراتك المهنية والعمليّة.\r\n', 'img1672776781.svg'),
(8, 'احصل على الشهادة', 'لتعزّز فرصك في إطلاق مسيرتك المهنية، أو تنميتها وتطويرها.\r\n', 'img1672776790.svg');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `price`, `language`, `user_id`, `hours`, `image`, `date`) VALUES
(8, 'أمن معلومات', ' أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات  أمن معلومات أمن معلومات ', 120, 'عربي', 17, 60, 'img1672776846.jpg', '2023-01-03 20:14:06'),
(9, 'شبكات', 'شبكات شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكات  شبكا', 100, 'عربي', 17, 50, 'img1672776891.jpg', '2023-01-03 20:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `discount_code`
--

CREATE TABLE `discount_code` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `text`, `status`) VALUES
(1, 'Omar', 'موقع جميل جدا الكورسات مفيدة للغاية سجلو في\n                                            الكورسات ومارح تندمو.موقع جميل جدا الكورسات مفيدة للغاية سجلو في\n                                            الكورسات ومارح تندمو.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discount_code` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `genderr` tinyint(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'user.jpg',
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `url`, `phone`, `address`, `city`, `genderr`, `image`, `role`) VALUES
(17, 'admin', 'admin@admin.com', 'cb9bff6ba1e4e9c51dd288a8e206ae1a', NULL, NULL, NULL, NULL, NULL, NULL, 'user.jpg', 'user'),
(30, 'Abood alagha', 'admin_abood@codia.com', '70873e8580c9900986939611618d7b1e', NULL, NULL, NULL, NULL, NULL, NULL, 'user.jpg', 'admin'),
(31, 'أ.محمد', 'Lec1@codia.com', '70873e8580c9900986939611618d7b1e', NULL, NULL, NULL, NULL, NULL, NULL, 'user.jpg', 'presenter'),
(32, 'administrator ', 'admin@codia.ps', 'c3284d0f94606de1fd2af172aba15bf3', NULL, NULL, NULL, NULL, NULL, NULL, 'user.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `discount_code`
--
ALTER TABLE `discount_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_course` (`course_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_lessons` (`course_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_orders` (`course_id`),
  ADD KEY `users_orders` (`user_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses` (`course_id`),
  ADD KEY `users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `benefits`
--
ALTER TABLE `benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `discount_code`
--
ALTER TABLE `discount_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `discount_code`
--
ALTER TABLE `discount_code`
  ADD CONSTRAINT `discount_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `course_lessons` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `course_orders` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `users_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
