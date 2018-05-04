CREATE TABLE `albums` (
	`id` int(11) UNSIGNED NOT NULL,
	`artist_id` int(11) UNSIGNED NOT NULL,
	`title` varchar(255) NOT NULL,
	`year` int(4) NOT NULL,
	`image` varchar(255) DEFAULT NULL
);

CREATE TABLE `artists` (
	`id` int(11) UNSIGNED NOT NULL,
	`name` varchar(255) NOT NULL,
	`description` text DEFAULT NULL
);

CREATE TABLE `songs` (
	`id` int(11) UNSIGNED NOT NULL,
	`album_id` int(11) UNSIGNED NOT NULL,
	`track_nr` int(11) NOT NULL,
	`title` varchar(255) NOT NULL,
	`duration` varchar(255) NOT NULL
);

ALTER TABLE `albums`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `albums`
	MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT; 


ALTER TABLE `artists`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `artists`
	MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT; 


ALTER TABLE `songs`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `songs`
	MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT; 

ALTER TABLE `albums`
    ADD CONSTRAINT `artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`);

ALTER TABLE `songs`
    ADD CONSTRAINT `album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`);
