-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 24, 2020 at 07:59 AM
-- Server version: 10.5.2-MariaDB-1:10.5.2+maria~bionic
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `blog_db`;

use `blog_db`;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL DEFAULT 'Mindfulness meditation',
  `description` varchar(255) NOT NULL DEFAULT 'Meditation article',
  `date` date NOT NULL DEFAULT curdate(),
  `author_id` int(11) NOT NULL DEFAULT 1,
  `featured_image` int(11) DEFAULT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `description`, `date`, `author_id`, `featured_image`, `text`) VALUES
(10, 'What is Mindfulness?', 'An introduction to mindfulness', '2019-06-09', 1, 2, '\r\nFor me, the simplest definition of mindfulness is knowing where your attention is directed in the present moment. This is a bit different from being “caught up in the moment” when we are sort of lost in the moment, in our thinking or whatever we are doing. The main difference I think is the knowledge of where your attention is directed at present.\r\nDeveloping mindfulness then is a matter of choosing something to pay attention to and deliberately directing your attention to it. This could be the sensations in your body, your breathing, your immediate surroundings, your thoughts and feelings or sounds. If you know where your mind is at, then you are being mindful, if not it is simply a matter of redirecting your attention to whatever you have chosen to be aware of.\r\n\r\n## Why practice mindfulness?\r\n\r\nPeople practice mindfulness for all sorts of reasons including relaxation, spiritual development and ‘self improvement’. It is often utilized to help treat and manage various mental health conditions including stress, anxiety and depression. My advice to those looking for help with serious mental illnesses is to practice mindfulness under the guidance of a qualified mental health practitioner, preferably one with mindfulness experience. Mindfulness is a useful tool in treating mental health conditions, but it is not a panacea.\r\nI personally like to practice mindfulness both for its numerous mental health benefits and simply for the pleasure of having a clear and quiet mind. I have experienced over the years a greater level of control (not mastery) over my thoughts and emotions as a result of developing the skill of mindfulness.\r\n\r\n## A skill and a habit\r\n\r\nWhatever draws you to the practice of mindfulness it is important to understand that it is a skill that is developed over time, not an experience to be gained instantly and easily. The benefits of mindfulness are only gained after consistent and regular practice. It’s a bit like learning a musical instrument. Most people can’t even make a tune when they first pick up a new instrument, however after a few months or years of practice they gain the joy of creating music.\r\nWhile it\'s important to be consistent in practicing mindfulness, it’s best not to become obsessed with it. You don’t need to be mindful twenty-four hours a day to benefit from it.\r\n\r\n## Getting started\r\n\r\nOne of the best ways to introduce yourself to mindfulness is with guided meditations. These are pre recorded talks where someone talks you through a formal mindfulness meditation. The website and app at Smiling Mind have lots of guided meditations to get you started.\r\n'),
(11, 'Sitting Meditation', 'Brief instructions on how to sit meditation', '2020-10-11', 1, 3, 'Find a suitable place to sit for twenty minutes or so, somewhere you’re not likely to be distracted by other people or technology. Switch your phone to do not disturb and set a timer for however long you’d like to meditate for. Twenty minutes is a good amount of time for beginners. Forty five minutes or longer for more experienced meditators.\r\n\r\nSit on a chair or on the edge of a bed with both feet on the ground. Keep your back straight and head upright. Feel what it\'s like to just sit there with your eyes open for a few moments then gently close or half close your eyes.\r\n\r\nNow bring your attention to what’s happening in the present moment in and around you: sounds you can hear, feelings in your body, sensations of warmth or coolness. Feel the pressure of your body on the seat, notice how much of your legs are touching the seat, and the remainder which is more exposed to the space around you. Feel the weight of your feet connected to the floor and sense the distance or lack thereof between your feet. Notice the sensations in your back and adjust your posture if necessary. Feel your body as a whole, experiencing the sensation of sitting.\r\n\r\nAt this time you may start to notice your attention being distracted by thoughts. This is perfectly normal for all but the most seasoned meditation practitioners. When you notice you’ve been distracted simply acknowledge this and return your attention to the sensations in your body. Use your bodily awareness as a reference point to return your mind to the present moment and sustain it there.\r\n\r\nAfter grounding your attention in mindfulness of your bodily sensations, gently bring your attention to the sensations of breathing. Are you breathing in or out? Feel the breath in a broad way, notice your torso expanding and contacting, the sensation of air entering and leaving your nostrils, the feeling of the breath moving through your throat and sinus. You can even pay attention to the way your shoulders lift and then drop on the in and out breath.\r\n\r\nAgain if you notice you’ve been distracted by thinking, simply acknowledge this and bring your attention back to this broad awareness of the breathing process. Resist the urge to discourage yourself if you find yourself distracted. Instead encourage your mind for returning to mindfulness. “Oh good I noticed I was lost, now I’m meditating again, well done.” Something along those lines.\r\n\r\nAfter watching the breath like this for a while, try to watch a full breath from the start of the in-breath to the end of the out-breath. If you notice you get distracted simply acknowledge this and try again. Keep trying to watch each breath from start to finish, allowing yourself the freedom to ‘fall off’ and start again as many times as necessary, even if it happens on every breath.\r\n\r\nKeep practising like this until your timer finishes. Gently bring the session to a close by expanding your awareness to your general bodily sensations and the sounds around you. If you like, take some time to repeat some positive affirmations, then fully open your eyes.\r\n\r\nTake a few moments to stretch your body and get your body moving again before going about your business.'),
(12, 'Walking Meditation', 'Brief instructions on how to practice walking meditation', '2020-10-11', 1, 5, 'Find a flat, straight path about twenty steps end to end. Preferably somewhere you’re not likely to be disturbed. You can practise walking meditation barefooted or with your shoes on. If you intend on having a long session it is better to wear shoes to prevent hurting or injuring your feet. Switch your phone to do not disturb and set a timer for the desired length of time.\r\n\r\nStand at one end of the path with your chin up and gaze set at about five metres in front of you. Let your hands hang naturally by your sides. Start walking at an easy pace towards the other side, bringing your awareness to the sensations of walking, simply feeling what it’s like to walk, how it feels in your body and mind. When you reach the other side simply stop, turn around and begin walking again, being aware of your movements as you do so.\r\n\r\nBecome aware of your legs and feet as they move, your arms swinging, the slight rock in your hips. Become aware of the way your clothing feels on your body as it moves and the subtle sensation of air moving against any bare skin. These sensations are your reference point for present moment awareness. If you get distracted by thinking, acknowledge this and then renew your awareness of the walking sensations.\r\n\r\nContinue practising like this until your timer goes off.\r\n\r\n## Variations\r\n\r\nSlow your walking down slightly and direct most of your attention to your feet. Be aware of each step you take, focusing on the feeling of your feet moving through the air. Try to maintain a clear awareness of which foot is stepping. You can note each step in your mind, thinking: right foot, left foot, etc. However the majority of your attention should be focussed on the awareness of the experience, rather than the mental description. This can be a good way to learn to distinguish between thinking and awareness.\r\n\r\nWhen you reach the end of the path turn around, being aware of the movements of your feet as you do so. Pause for a moment to re-establish mindfulness before resuming your walk to the other side.\r\n\r\nKeep practising in this way until the end of your session.'),
(13, 'Guided Meditation', 'A transcription for a 20 minute guided breath awareness meditation', '2020-10-11', 1, NULL, 'This meditation will last about 20 minutes and will use the sensation of breathing as an aid to develop mindfulness.\r\n\r\nSit somewhere comfortable on a chair, the edge of a bed or on the floor with your legs crossed.\r\n\r\nIf you are sitting on a chair move slightly forward so your back is away from the back rest. We want to support our own back and maintain a comfortable but alert posture.\r\n\r\nTake a minute or two to make yourself as comfortable as you can: shift around on your seat, loosen your shoulders and neck, loosen any tight clothing.\r\n\r\n(brief pause)\r\n\r\nNow that you are comfortable gently close or half close your eyes.\r\n\r\nNow take 2 or 3 deep breaths, breathing in through the nose, and out through the mouth.\r\n\r\nNow breath naturally, breathing in and out through the nose. Pay attention to the sensation of breathing. Are you inhaling or exhaling? What sensations do you notice?\r\n\r\nCan you feel the air moving in and out through your nostrils?\r\n\r\nThe air moving over your upper lip?\r\n\r\nWhat about the back of your throat? Can you feel anything there?\r\n\r\nExplore the different sensations that arise from simply breathing in and breathing out.\r\n\r\nWhen you breath in do you notice your chest expanding?\r\n\r\nDo you feel your chest contracting as you breath out?\r\n\r\nCan you feel your stomach rising and falling as you breath?\r\n\r\nDo you notice how your shoulder blades open up slightly as you breath in, and close up slightly as you breath out?\r\n\r\nNotice all these subtle sensations which arise from the process of breathing.\r\n\r\nNow settle your focus on the sensation where you most easily feel your in and out breath. Consciously direct your attention here, knowing when you are breathing in and when you are breathing out.\r\n\r\n(pause)\r\n\r\nAs you are directing your attention to the sensations of breathing you may notice that you become distracted with other thoughts.\r\n\r\nThis is completely normal.\r\n\r\nWhen this happens simply make a mental note of what has distracted you, and consciously redirect your attention to the sensation of breathing.\r\n\r\nThis frequent re-establishing of mindfulness is an important part of meditation and brings powerful benefits.\r\n\r\nNow I will let you continue this process on your own for a while: focusing on the sensation of breathing, noticing when you are distracted and re-establishing mindfulness.\r\n\r\n(extended pause)\r\n\r\nNow that you\'ve been meditating for a while I want you to pay attention to the way you feel in your body and mind.\r\n\r\nDo you feel relaxed?\r\n\r\nIs your mind quieter?\r\n\r\nPerhaps you feel slightly anxious.\r\n\r\nAre you alert?\r\n\r\nOr maybe a little sleepy?\r\n\r\nAre you still comfortable or do you feel a bit tight?\r\n\r\nEach time you meditate you will feel slightly different.\r\n\r\nSimply notice these feelings in the present moment.\r\n\r\nSee if these sensations remain constant, or if they change.\r\n\r\nThe end of a meditation session is a good time to make a positive affirmation in your mind.\r\n\r\nSomething like: “I choose to live consciously. I create a bright future for myself. I am master of my fate”.\r\n\r\nChoose your own affirmation or feel free to use my suggestion.\r\n\r\nRepeat it consciously in your mind.\r\n\r\n(pause)\r\n\r\nWhen you are ready, slowly open your eyes, move your body around a bit and be on your way.'),
(19, 'Home', 'Welcome to Samadhi Journal', '2020-10-19', 1, 3, 'Here you will find instruction on *mindfulness* and *meditation* from my own perspective.  If you are just starting your journey into meditation I recommend starting with the [Guided Mediation](/blog/articles.php?article=13)\r\nYou may want to start by learning mindfulness of breathing or walking meditation.  Take what you find useful or appealing from the articles here and put it to use in your own practice.');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`) VALUES
(1, 'Osamu Morozumi', 'osamumorozumi@gmail.com', '8d3a85614b6f848c085a4919e4a3b4c2'),
(2, 'Randall Flagg', 'maninblack@darktower.com', '8d3a85614b6f848c085a4919e4a3b4c2'),
(3, 'Susannah Dean', 'odetta@newyork.com', '8d3a85614b6f848c085a4919e4a3b4c2');

-- --------------------------------------------------------

--
-- Table structure for table `author_role`
--

CREATE TABLE `author_role` (
  `author_id` int(11) NOT NULL,
  `role_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author_role`
--

INSERT INTO `author_role` (`author_id`, `role_id`) VALUES
(1, 'Account Administrator'),
(1, 'Content Editor'),
(1, 'Site Administrator'),
(2, 'Account Administrator'),
(2, 'Content Editor'),
(3, 'Account Administrator'),
(3, 'Content Editor');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'beginners'),
(2, 'guided meditation'),
(5, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alt_text` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `alt_text`) VALUES
(1, 'meditation-grasses.jpg', 'man sitting cross legged in meditation on grassy hill'),
(2, 'balance.jpg', 'balanced rocks at beach with sunset'),
(3, 'sitting-meditation.jpg', 'woman sitting meditation in nature'),
(4, 'road.jpg', 'dirt road shaded by trees'),
(5, 'hiking.jpg', 'man walking down mountain path'),
(6, 'light-texture.jpg', 'textured background'),
(7, 'logo.png', 'samadhi journal logo png'),
(8, 'logo.svg', 'samadhi journal logo svg'),
(9, 'profile.jpg', 'picture of the author'),
(10, 'snow.jpg', 'snowy ground');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `description`, `price`) VALUES
(1, 'How to meditate instructional DVD', 24.95),
(2, 'Meditation timer', 20),
(3, 'Mindfulness of Breathing instructional book', 29.99),
(4, 'Meditation cushion', 39.95);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
('Account Administrator', 'Add, remove, and edit authors'),
('Content Editor', 'Add, remove, and edit jokes'),
('Site Administrator', 'Add, remove, and edit categories');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_id`,`category_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_role`
--
ALTER TABLE `author_role`
  ADD PRIMARY KEY (`author_id`,`role_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
