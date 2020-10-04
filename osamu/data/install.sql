
CREATE DATABASE IF NOT EXISTS `blog_db`;

use `blog_db`;

-- create tables 

-- author table
CREATE TABLE `author` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL, -- bcrypt hash. PASSWORD_DEFAULT - Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to change over time as new and stronger algorithms are added to PHP. For that reason, the length of the result from using this identifier can change over time. Therefore, it is recommended to store the result in a database column that can expand beyond 60 characters (255 characters would be a good choice). https://www.php.net/manual/en/function.password-hash.php
	PRIMARY KEY (`id`)
);

-- author_role
CREATE TABLE `author_role` (
  `author_id` INT NOT NULL,
  `role_id` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`author_id`, `role_id`)
); 

-- image table
CREATE TABLE `image` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL DEFAULT '',
	`alt_text` VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
);

-- category table
CREATE TABLE `category` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL ,
	PRIMARY KEY (`id`)
);

-- articles
CREATE TABLE `article` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(45) NOT NULL DEFAULT 'Mindfulness meditation',
	`description` VARCHAR(255) NOT NULL DEFAULT 'Meditation article',
	`date` DATE NOT NULL DEFAULT CURDATE(),
	`author_id` INT NOT NULL DEFAULT 1,
	`featured_image` INT NOT NULL DEFAULT 1,
	`text` TEXT NOT NULL,
	PRIMARY KEY (`id`)
);

-- article_category lookup table
CREATE TABLE `article_category` (
	`article_id` INT NOT NULL,
	`category_id` INT NOT NULL,
	PRIMARY KEY (`article_id`, `category_id`)
);

-- populate tables

-- populate user, bcrypt hashes generated at https://bcrypt-generator.com/
INSERT INTO `author` (`name`, `email`, `password`) VALUES 
	('Osamu Morozumi', 'osamumorozumi@gmail.com', '$2y$12$SfQeWm7l.p3zdBTx4twHK.EMhnFu3um2Tw/KyQZuD8cfbsu/IViT.'), -- password 'admin'
	('Randall Flagg', 'maninblack@darktower.net', '$2y$12$JWCVxX.JudkHnKkXb4O8F.n3KM08n01L1m4sjJBhWOBHfZGzOmds6'), -- password 'sorcerer'
	('Susannah Dean', 'odetta@newyork.com', '$2y$12$aSGYeO1LOdzgyv5JFx.4luXI9jglIhwts/zMhsFVnuWEt74r/II6W') -- password 'mia'
; 

-- populate author_role
INSERT INTO `author_role` (`author_id`, `role_id`) VALUES
(1, 'Account Administrator'),
(1, 'Content Editor'),
(1, 'Site Administrator'),
(2, 'Account Administrator'),
(2, 'Content Editor'),
(3, 'Content Editor');

-- populate category
INSERT INTO `category` (`name`) VALUES
	('beginners'),
	('guided meditation')
;

-- populate image
INSERT INTO `image` (`id`, `name`, `alt_text`) VALUES
	(1, 'meditation-grass.jpg', 'man sitting in meditation on grass'), -- default featured image
	(2, 'balance.jpg', 'balanced rocks at beach with sunset'),
	(3, 'sitting-meditation.jpg', 'woman sitting meditation in nature'),
	(4, 'road.jpg', 'dirt road shaded by trees'),
	(5, 'hiking.jpg', 'man walking down mountain path'),
	(6, 'light-texture.jpg', ''), -- background texture
	(7, 'logo.png', 'samadhi journal logo'),
	(8, 'logo.svg', 'samadhi journal logo'),
	(9, 'osamu-profile.jpg', 'picture of the author'),
	(10, 'snow.jpg', 'snowy ground')
;

-- populate article text is uploaded as markdown surrounded by double quotes to avoid the need to escape single quotes
INSERT INTO `article` (`title`, `description`, `date`, `author_id`, `featured_image`, `text`) VALUES
(
	'What is Mindfulness?', 'An introduction to mindfulness', '2019-06-09', 1, 2, 
"
For me, the simplest definition of mindfulness is knowing where your attention is directed in the present moment. This is a bit different from being “caught up in the moment” when we are sort of lost in the moment, in our thinking or whatever we are doing. The main difference I think is the knowledge of where your attention is directed at present.
Developing mindfulness then is a matter of choosing something to pay attention to and deliberately directing your attention to it. This could be the sensations in your body, your breathing, your immediate surroundings, your thoughts and feelings or sounds. If you know where your mind is at, then you are being mindful, if not it is simply a matter of redirecting your attention to whatever you have chosen to be aware of.

## Why practice mindfulness?

People practice mindfulness for all sorts of reasons including relaxation, spiritual development and ‘self improvement’. It is often utilized to help treat and manage various mental health conditions including stress, anxiety and depression. My advice to those looking for help with serious mental illnesses is to practice mindfulness under the guidance of a qualified mental health practitioner, preferably one with mindfulness experience. Mindfulness is a useful tool in treating mental health conditions, but it is not a panacea.
I personally like to practice mindfulness both for its numerous mental health benefits and simply for the pleasure of having a clear and quiet mind. I have experienced over the years a greater level of control (not mastery) over my thoughts and emotions as a result of developing the skill of mindfulness.

## A skill and a habit

Whatever draws you to the practice of mindfulness it is important to understand that it is a skill that is developed over time, not an experience to be gained instantly and easily. The benefits of mindfulness are only gained after consistent and regular practice. It’s a bit like learning a musical instrument. Most people can’t even make a tune when they first pick up a new instrument, however after a few months or years of practice they gain the joy of creating music.
While it's important to be consistent in practicing mindfulness, it’s best not to become obsessed with it. You don’t need to be mindful twenty-four hours a day to benefit from it.

## Getting started

One of the best ways to introduce yourself to mindfulness is with guided meditations. These are pre recorded talks where someone talks you through a formal mindfulness meditation. The website and app at Smiling Mind have lots of guided meditations to get you started.
"
),
(
	'Sitting Meditation', 'Brief instructions on how to sit meditation', '2019-06-09', 1, 3,
"
Find a suitable place to sit for twenty minutes or so, somewhere you’re not likely to be distracted by other people or technology. Switch your phone to do not disturb and set a timer for however long you’d like to meditate for. Twenty minutes is a good amount of time for beginners. Forty five minutes or longer for more experienced meditators.

Sit on a chair or on the edge of a bed with both feet on the ground. Keep your back straight and head upright. Feel what it's like to just sit there with your eyes open for a few moments then gently close or half close your eyes.

Now bring your attention to what’s happening in the present moment in and around you: sounds you can hear, feelings in your body, sensations of warmth or coolness. Feel the pressure of your body on the seat, notice how much of your legs are touching the seat, and the remainder which is more exposed to the space around you. Feel the weight of your feet connected to the floor and sense the distance or lack thereof between your feet. Notice the sensations in your back and adjust your posture if necessary. Feel your body as a whole, experiencing the sensation of sitting.

At this time you may start to notice your attention being distracted by thoughts. This is perfectly normal for all but the most seasoned meditation practitioners. When you notice you’ve been distracted simply acknowledge this and return your attention to the sensations in your body. Use your bodily awareness as a reference point to return your mind to the present moment and sustain it there.

After grounding your attention in mindfulness of your bodily sensations, gently bring your attention to the sensations of breathing. Are you breathing in or out? Feel the breath in a broad way, notice your torso expanding and contacting, the sensation of air entering and leaving your nostrils, the feeling of the breath moving through your throat and sinus. You can even pay attention to the way your shoulders lift and then drop on the in and out breath.

Again if you notice you’ve been distracted by thinking, simply acknowledge this and bring your attention back to this broad awareness of the breathing process. Resist the urge to discourage yourself if you find yourself distracted. Instead encourage your mind for returning to mindfulness. “Oh good I noticed I was lost, now I’m meditating again, well done.” Something along those lines.

After watching the breath like this for a while, try to watch a full breath from the start of the in-breath to the end of the out-breath. If you notice you get distracted simply acknowledge this and try again. Keep trying to watch each breath from start to finish, allowing yourself the freedom to ‘fall off’ and start again as many times as necessary, even if it happens on every breath.

Keep practising like this until your timer finishes. Gently bring the session to a close by expanding your awareness to your general bodily sensations and the sounds around you. If you like, take some time to repeat some positive affirmations, then fully open your eyes.

Take a few moments to stretch your body and get your body moving again before going about your business.
"
),
(
	'Walking Meditation', 'Brief instructions on how to practice walking meditation', '2019-06-09', 1, 4,
"
Find a flat, straight path about twenty steps end to end. Preferably somewhere you’re not likely to be disturbed. You can practise walking meditation barefooted or with your shoes on. If you intend on having a long session it is better to wear shoes to prevent hurting or injuring your feet. Switch your phone to do not disturb and set a timer for the desired length of time.

Stand at one end of the path with your chin up and gaze set at about five metres in front of you. Let your hands hang naturally by your sides. Start walking at an easy pace towards the other side, bringing your awareness to the sensations of walking, simply feeling what it’s like to walk, how it feels in your body and mind. When you reach the other side simply stop, turn around and begin walking again, being aware of your movements as you do so.

Become aware of your legs and feet as they move, your arms swinging, the slight rock in your hips. Become aware of the way your clothing feels on your body as it moves and the subtle sensation of air moving against any bare skin. These sensations are your reference point for present moment awareness. If you get distracted by thinking, acknowledge this and then renew your awareness of the walking sensations.

Continue practising like this until your timer goes off.

## Variations

Slow your walking down slightly and direct most of your attention to your feet. Be aware of each step you take, focusing on the feeling of your feet moving through the air. Try to maintain a clear awareness of which foot is stepping. You can note each step in your mind, thinking: right foot, left foot, etc. However the majority of your attention should be focussed on the awareness of the experience, rather than the mental description. This can be a good way to learn to distinguish between thinking and awareness.

When you reach the end of the path turn around, being aware of the movements of your feet as you do so. Pause for a moment to re-establish mindfulness before resuming your walk to the other side.

Keep practising in this way until the end of your session.
"
),
(
	'Guided Meditation', 'A transcription for a 20 minute guided breath awareness meditation', '2020-05-03', 1, 3,
"
This meditation will last about 20 minutes and will use the sensation of breathing as an aid to develop mindfulness.

Sit somewhere comfortable on a chair, the edge of a bed or on the floor with your legs crossed.

If you are sitting on a chair move slightly forward so your back is away from the back rest. We want to support our own back and maintain a comfortable but alert posture.

Take a minute or two to make yourself as comfortable as you can: shift around on your seat, loosen your shoulders and neck, loosen any tight clothing.

(brief pause)

Now that you are comfortable gently close or half close your eyes.

Now take 2 or 3 deep breaths, breathing in through the nose, and out through the mouth.

Now breath naturally, breathing in and out through the nose. Pay attention to the sensation of breathing. Are you inhaling or exhaling? What sensations do you notice?

Can you feel the air moving in and out through your nostrils?

The air moving over your upper lip?

What about the back of your throat? Can you feel anything there?

Explore the different sensations that arise from simply breathing in and breathing out.

When you breath in do you notice your chest expanding?

Do you feel your chest contracting as you breath out?

Can you feel your stomach rising and falling as you breath?

Do you notice how your shoulder blades open up slightly as you breath in, and close up slightly as you breath out?

Notice all these subtle sensations which arise from the process of breathing.

Now settle your focus on the sensation where you most easily feel your in and out breath. Consciously direct your attention here, knowing when you are breathing in and when you are breathing out.

(pause)

As you are directing your attention to the sensations of breathing you may notice that you become distracted with other thoughts.

This is completely normal.

When this happens simply make a mental note of what has distracted you, and consciously redirect your attention to the sensation of breathing.

This frequent re-establishing of mindfulness is an important part of meditation and brings powerful benefits.

Now I will let you continue this process on your own for a while: focusing on the sensation of breathing, noticing when you are distracted and re-establishing mindfulness.

(extended pause)

Now that you've been meditating for a while I want you to pay attention to the way you feel in your body and mind.

Do you feel relaxed?

Is your mind quieter?

Perhaps you feel slightly anxious.

Are you alert?

Or maybe a little sleepy?

Are you still comfortable or do you feel a bit tight?

Each time you meditate you will feel slightly different.

Simply notice these feelings in the present moment.

See if these sensations remain constant, or if they change.

The end of a meditation session is a good time to make a positive affirmation in your mind.

Something like: “I choose to live consciously. I create a bright future for myself. I am master of my fate”.

Choose your own affirmation or feel free to use my suggestion.

Repeat it consciously in your mind.

(pause)

When you are ready, slowly open your eyes, move your body around a bit and be on your way.
"
)
;

-- article_category
INSERT INTO `article_category` VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2)
;