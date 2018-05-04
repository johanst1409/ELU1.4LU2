INSERT INTO `artists` (`id`, `name`, `description`) VALUES
(1, 'AC/DC', 'AC/DC are an Australian rock band, formed in Sydney in 1973 by brothers Malcolm and Angus Young. A hard rock/blues rock band, listeners have also classified their music as heavy metal, although they refer to themselves as "a rock and roll band, nothing more, nothing less".'),
(2, 'Rammstein', 'Rammstein is a German heavy metal band, formed in 1994 in Berlin, Germany. Throughout its existence, Rammstein\'s six-man lineup has remained unchanged—lead guitarist Richard Z. Kruspe, bassist Oliver "Ollie" Riedel, drummer Christoph "Doom" Schneider, lead vocalist Till Lindemann, rhythm guitarist Paul H. Landers, and keyboardist Christian "Flake" Lorenz.');

INSERT INTO `albums` (`id`, `artist_id`, `title`, `year`, `image`) VALUES
(1, 2, 'Mutter', 2001, 'mutter-2001.jpg'),
(2, 2, 'Reise, Reise', 2004, 'reise-reise-2004.jpg');

INSERT INTO `songs` (`album_id`, `track_nr`, `title`, `duration`) VALUES
(1, 1, 'Mein Herz brennt', '4:39'),
(1, 2, 'Links 2 3 4', '3:36'),
(1, 3, 'Sonne', '4:32'),
(1, 4, 'Ich will', '3:37'),
(1, 5, 'Feuer frei!', '3:08'),
(1, 6, 'Mutter', '4:28'),
(1, 7, 'Spieluhr', '4:46'),
(1, 8, 'Zwitter', '4:17'),
(1, 9, 'Rein raus', '3:09'),
(1, 10, 'Adios', '3:48'),
(1, 11, 'Nebel', '4:54'),
(2, 1, 'Reis, Reise', '4:11'),
(2, 11, 'Amour', '4:50'),
(2, 10, 'Ohne Dich', '4:31'),
(2, 9, 'Stein um Stein', '3:52'),
(2, 8, 'Morgenstern', '3:59'),
(2, 7, 'Moskau', '4:16'),
(2, 6, 'Amerika', '3:46'),
(2, 5, 'Los', '4:23'),
(2, 4, 'Keine Lust', '3:42'),
(2, 3, 'Dalai Lama', '5.38'),
(2, 2, 'Mein Teil', '4:32');
