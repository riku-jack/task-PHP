-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-06-19 15:56:35
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `forum`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `c_created_by` int(11) NOT NULL,
  `c_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `c_created_by`, `c_created`, `res_id`) VALUES
(29, '６へのコメントです。', 5, '2023-06-04 09:34:39', 17),
(32, '実験２へのコメントです。idは１２', 6, '2023-06-05 11:49:36', 12),
(35, '鈴木さんへコメント　res_id18', 5, '2023-06-16 03:17:39', 18),
(51, '私は鈴木です。', 6, '2023-06-17 02:34:46', 18),
(52, '鈴木のコメントです。', 6, '2023-06-17 02:36:32', 20),
(58, '私も山田です。', 5, '2023-06-17 06:12:37', 21),
(59, '山田です。', 5, '2023-06-18 09:59:48', 22),
(61, 'こんにちは', 5, '2023-06-18 10:29:10', 23),
(90, '私は山田です。', 5, '2023-06-19 06:54:32', 20);

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `created`, `modified`) VALUES
(5, '山田', 'riku_823@hotmail.com', '$2y$10$2K3SHnvlbjnTntMkZjvdMOXF.5Ol0XGE.8p2MqDBO4D5VmvTgYbRa', '2023-05-24 14:42:45', '2023-05-24 14:42:45'),
(6, '鈴木', 'rikujack823@gmail.com', '$2y$10$zXw1IfutVGkhtVjehyvtbe08AKL0isCHioUt4QiXK/e/RoTZhx/YO', '2023-06-05 11:46:08', '2023-06-05 11:46:08');

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `post`, `created_by`, `created`, `modified`) VALUES
(18, '鈴木のコメントです。', 6, '2023-06-05 11:46:34', '2023-06-05 11:46:34'),
(19, '山田のコメントです。', 5, '2023-06-17 02:21:01', '2023-06-17 02:21:01'),
(20, '私は鈴木です。', 6, '2023-06-17 02:36:15', '2023-06-17 02:36:15'),
(21, '私は山田です。', 5, '2023-06-17 02:37:10', '2023-06-17 02:37:10'),
(22, '実験', 5, '2023-06-17 06:16:19', '2023-06-17 06:16:19'),
(23, 'こんにちは', 5, '2023-06-18 10:00:25', '2023-06-18 10:00:25');

-- --------------------------------------------------------

--
-- テーブルの構造 `pre_members`
--

CREATE TABLE `pre_members` (
  `id` int(11) NOT NULL,
  `urltoken` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `date` datetime NOT NULL,
  `flag` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `pre_members`
--

INSERT INTO `pre_members` (`id`, `urltoken`, `email`, `date`, `flag`) VALUES
(20, 'cdbf3a8bb443edc51c3ca6ce9f4589542ce1346d6c075067419895b43aaefe5e', 'riku_823@hotmail.com', '2023-05-24 16:12:40', 0),
(21, '21c3656ccfc3ccee49202c78a5226677d31c212610d361d7e54507de21725d41', 'riku_823@hotmail.com', '2023-05-24 16:12:45', 0),
(22, '84e9cdaba77aeb2f353441dc28201319f2463301e6e76dbe01e283f35c3fa60a', 'riku_823@hotmail.com', '2023-05-24 16:12:45', 0),
(23, '1c53afc4dfbe24f743b4a2875b5fc534763a2548dd5b0ef1e25da3ea706d2018', 'rikujack823@gmail.com', '2023-05-24 16:17:26', 0),
(24, 'c2a59a8f7b3f662747f97ca8dcf18fa771889f40ad97c50d3b9eb5464eeed175', 'riku_823@hotmail.com', '2023-05-24 16:29:43', 0),
(25, 'eaf0047bee51f9aafce2272666d16286af549f8aa5a69a0e7d17e37bf6493c43', 'riku_823@hotmail.com', '2023-05-24 16:31:01', 0),
(26, '7bc790ea5064c714fda5c5949d17527638cd40f69728d492a0d3772ab8bd4230', 'riku_823@hotmail.com', '2023-05-24 16:40:31', 0),
(27, '7ed492359a53ad3d84445042f3cc032b3fb0ed8303706485fe3ed214ad4c127d', 'riku_823@hotmail.com', '2023-05-24 16:43:15', 0),
(28, '2fc7678295c7708ae52cc0a1799d13c1ed512ea4cb77ce15ead15307ee886be2', 'riku_823@hotmail.com', '2023-05-24 16:43:47', 0),
(29, '41ce5ac9de331229c605fef5ec39d6364ea0d6486380f293a6c2f773262b1822', 'riku_823@hotmail.com', '2023-05-24 16:45:12', 0),
(30, 'ceafd3b7dbc61c5d42e95b63fef888b12df0db3494bf66865239778a89ae15b8', 'riku_823@hotmail.com', '2023-05-24 16:46:08', 0),
(31, '41bb497a6f4a117caab9f5c9b21f1b46b13026338e41a379ce13b05cac72e9ae', 'riku_823@hotmail.com', '2023-05-24 16:46:50', 0),
(32, '06c0e86f3b5f01618c596fce486aff5fdcd6e1e89d655dcce3e16e474077bb64', 'riku_823@hotmail.com', '2023-05-24 23:42:21', 0),
(33, '5996c9032c74bdc6ae0f46adfe93c27befbb00f6043d784e15d323dd17ed940e', 'rikujack823@gmail.com', '2023-06-05 20:45:44', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- テーブルのインデックス `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `pre_members`
--
ALTER TABLE `pre_members`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- テーブルの AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- テーブルの AUTO_INCREMENT `pre_members`
--
ALTER TABLE `pre_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
