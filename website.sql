
CREATE TABLE `pg_info` (
  `id` int(255) NOT NULL,
  `name` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
);

--
-- Dumping data for table `pg_info`
--

INSERT INTO `pg_info` (`id`, `name`, `address`, `description`, `image`) VALUES
(1, 'sara recidancy', 'sawantwadi', 'boys, mess', 'uploads/samplepg2.jpg'),
(2, 'xyz residency', 'sawantwadi', 'girls', 'uploads/demopg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
);

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'mitesh Ghadi', 'miteshghadi@gmail.com', 'Mitesh', 'admin'),
(2, 'januu kharat', 'janukharat42@gmail.com', 'de32a16491dab6f128ca09dd29fa7dad', 'admin'),
(4, 'abc', 'abc@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(11, 'yash gaosvi', 'gosaviyash47@gmail.com', 'f0c5d9fe377c9a0581bc7eb72b61a281', 'admin'),
(17, 'elvis fernandes', 'fernandeselvis07@gmail.com', '5a692cc6b4fc908c16da984a3e41e16f', 'admin'),
(18, 'Lawoo Warang', 'waranglawoo@gmail.com', 'f0c5d9fe377c9a0581bc7eb72b61a281', 'admin');
