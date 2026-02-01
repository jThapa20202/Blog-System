-- phpMyAdmin SQL Dump
-- version 5.2.3-1.el10_2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2026 at 04:29 AM
-- Server version: 10.11.15-MariaDB
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `np02cs4a240089`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Technology'),
(2, 'Lifestyle'),
(3, 'Travel'),
(4, 'Food'),
(5, 'AI & Society');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `category_id`, `created_at`) VALUES
(1, 'The Evolution of Technology in the Digital Age', 'Technology has evolved at an unprecedented pace over the last few decades, fundamentally transforming how societies function and how individuals interact with the world. From the early days of simple computing machines to today’s advanced artificial intelligence systems, technological progress has reshaped communication, education, healthcare, and business operations.\r\n\r\nThe rise of the internet marked a major turning point in human history. Information that once took days or weeks to access became available within seconds. Social media platforms emerged as powerful tools for communication, allowing people to connect across geographical boundaries. While these platforms enhance connectivity, they also raise concerns related to misinformation, digital addiction, and online privacy.\r\n\r\nIn the business world, technology has enabled automation, cloud computing, and data-driven decision-making. Companies now rely on big data analytics to understand consumer behavior and improve efficiency. Small businesses benefit from digital tools that allow them to compete on a global scale. However, rapid technological change also demands continuous learning, as outdated skills can quickly become irrelevant.\r\n\r\nDespite its advantages, technological advancement must be managed responsibly. Ethical issues such as data misuse, cybersecurity threats, and unequal access to technology continue to challenge modern societies. Bridging the digital divide and promoting ethical innovation are essential to ensuring that technology benefits everyone equally.', 1, '2026-02-01 04:28:46'),
(2, 'Balancing Lifestyle and Mental Well-being in a Fast-Paced World', 'In today’s fast-paced world, maintaining a healthy lifestyle has become increasingly challenging. Academic pressure, work deadlines, and constant digital engagement often lead to stress and burnout. A balanced lifestyle plays a crucial role in preserving both physical health and mental well-being.\r\n\r\nHealthy habits such as regular exercise, proper sleep, and mindful eating contribute significantly to improved concentration and emotional stability. Mental well-being is equally important and can be supported through practices such as meditation, journaling, and meaningful social interactions. Taking breaks from digital devices helps reduce anxiety and improves overall quality of life.\r\n\r\nModern lifestyles often prioritize productivity over personal health, which can have long-term consequences. Individuals must learn to set boundaries, manage time effectively, and prioritize self-care. Educational institutions and workplaces also have a responsibility to promote wellness through supportive policies and awareness programs.\r\n\r\nUltimately, a balanced lifestyle is not about perfection but about consistency. Small, positive changes made daily can lead to long-term benefits, creating a healthier and more fulfilling life.', 2, '2026-02-01 04:28:46'),
(3, 'Travel as a Tool for Personal Growth and Cultural Understanding', 'Travel is more than just visiting new places; it is a powerful tool for personal growth and cultural understanding. Experiencing different cultures, traditions, and lifestyles broadens perspectives and encourages open-mindedness. Travel allows individuals to step outside their comfort zones and adapt to unfamiliar environments.\r\n\r\nExploring new destinations enhances problem-solving skills and builds confidence. Interacting with people from diverse backgrounds fosters empathy and respect for cultural differences. In addition, travel contributes to mental well-being by reducing stress and providing opportunities for relaxation and reflection.\r\n\r\nHowever, responsible travel is essential. Sustainable tourism practices help protect the environment and support local communities. Travelers should respect local customs, minimize environmental impact, and contribute positively to the places they visit.\r\n\r\nIn a globalized world, travel plays a vital role in promoting cross-cultural understanding and global unity. It enriches lives by creating lasting memories and valuable life lessons.', 3, '2026-02-01 04:28:46'),
(4, 'Artificial Intelligence and Ethical Challenges in the Modern World', 'Artificial Intelligence has become one of the most influential technologies of the modern era. Its applications range from healthcare diagnostics and autonomous vehicles to personalized education and smart cities. AI systems process vast amounts of data to identify patterns and make predictions that enhance efficiency and accuracy.\r\n\r\nDespite its benefits, AI presents significant ethical challenges. Issues such as algorithmic bias, lack of transparency, and surveillance misuse have sparked global concern. AI models trained on biased data may reinforce social inequalities, leading to unfair outcomes in hiring, lending, or law enforcement.\r\n\r\nAnother major concern is the impact of AI on employment. Automation threatens traditional jobs while creating new opportunities that require advanced technical skills. Governments and institutions must invest in education and reskilling programs to prepare individuals for an AI-driven workforce.\r\n\r\nThe responsible development of AI requires collaboration between technologists, policymakers, and society. Ethical frameworks, clear regulations, and transparency are essential to ensuring that AI serves humanity positively and sustainably.', 5, '2026-02-01 04:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
