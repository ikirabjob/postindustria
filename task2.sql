CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `value` (`value`);

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` text
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);


CREATE TABLE `link` (
  `data_id` int(11) NOT NULL,
  `info_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

ALTER TABLE `link`
  ADD KEY `data_id` (`data_id`),
  ADD KEY `info_id` (`info_id`);




SELECT i.id ,i.name, i.desc, d.id, d.date, d.value
FROM link l
RIGHT JOIN data d ON d.id = l.data_id
RIGHT JOIN info i ON i.id = l.info_id