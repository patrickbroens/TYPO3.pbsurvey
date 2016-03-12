#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	pbsurvey_access_level tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_anonymous_mode tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_cancel_page int(10) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_captcha tinyint(1) DEFAULT '0' NOT NULL,
	pbsurvey_completion_action tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_completion_close_button tinyint(1) DEFAULT '0' NOT NULL,
	pbsurvey_completion_continue_button tinyint(1) DEFAULT '0' NOT NULL,
	pbsurvey_completion_page int(10) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_cookie_lifetime smallint(5) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_days_for_update smallint(5) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_entering_stage tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_first_column_width tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_mail_body text NOT NULL,
	pbsurvey_mail_cc varchar(255) DEFAULT '' NOT NULL,
	pbsurvey_mail_from_address varchar(255) DEFAULT '' NOT NULL,
	pbsurvey_mail_from_name varchar(255) DEFAULT '' NOT NULL,
	pbsurvey_mail_send_type tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_mail_subject varchar(255) DEFAULT '' NOT NULL,
	pbsurvey_mail_to varchar(255) DEFAULT '' NOT NULL,
	pbsurvey_maximum_responses smallint(5) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_navigation_back tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_navigation_cancel tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_numbering_page tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_numbering_question tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_responses_per_user smallint(5) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_scoring tinyint(3) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_storage_folder int(10) unsigned DEFAULT '0' NOT NULL,
	pbsurvey_validation tinyint(3) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_pbsurvey_answer'
#
CREATE TABLE tx_pbsurvey_answer (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(10) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

	item int(11) unsigned DEFAULT '0' NOT NULL,
	item_option int(11) unsigned DEFAULT '0' NOT NULL,
	item_option_row int(11) DEFAULT '0' NOT NULL,
	open text NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY parent (parentid)
);

#
# Table structure for table 'tx_pbsurvey_item'
#
CREATE TABLE tx_pbsurvey_item (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(10) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	answers_additional_allow tinyint(3) unsigned DEFAULT '0' NOT NULL,
	answers_additional_text tinytext NOT NULL,
	answers_additional_type tinyint(3) unsigned DEFAULT '0' NOT NULL,
	answers_none tinyint(3) unsigned DEFAULT '0' NOT NULL,

	date_default int(11) DEFAULT '0' NOT NULL,
	date_maximum int(11) DEFAULT '0',
	date_minimum int(11) DEFAULT '0',

	display_type tinyint(3) unsigned DEFAULT '0' NOT NULL,

	email tinyint(3) unsigned DEFAULT '0' NOT NULL,

	file_reference int(11) DEFAULT '0' NOT NULL,
	file_references int(11) DEFAULT '0' NOT NULL,

	heading tinytext NOT NULL,

	html text NOT NULL,

	image_alignment tinyint(3) unsigned DEFAULT '0' NOT NULL,
	image_height int(11) DEFAULT '0',
	image_width int(11) DEFAULT '0',
	images blob NOT NULL,

	length_maximum int(11) DEFAULT '0',

	message text NOT NULL,

	negative_first tinyint(3) unsigned DEFAULT '0' NOT NULL,

	number_end int(11) DEFAULT '0',
	number_start int(11) DEFAULT '0',
	number_total int(11) DEFAULT '0',

	option_rows text NOT NULL,
	options int(11) DEFAULT '0' NOT NULL,
	options_alignment int(11) unsigned DEFAULT '0' NOT NULL,
	options_predefined_group int(11) DEFAULT '0' NOT NULL,
	options_random tinyint(3) unsigned DEFAULT '0' NOT NULL,
	options_required tinyint(3) unsigned DEFAULT '0' NOT NULL,
	options_responses_maximum int(11) DEFAULT '0' NOT NULL,
	options_responses_minimum int(11) DEFAULT '0' NOT NULL,
	options_row_heading_width int(11) DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	question tinytext NOT NULL,
	question_alias tinytext NOT NULL,
	question_subtext text NOT NULL,
	question_type int(11) unsigned DEFAULT '0' NOT NULL,

	selectbox_height int(11) DEFAULT '0',

	styleclass tinytext NOT NULL,

	textarea_height int(11) DEFAULT '0',
	textarea_width int(11) DEFAULT '0',

	value_default_numeric int(11) DEFAULT '0',
	value_default_text tinytext NOT NULL,
	value_default_true_false tinyint(3) unsigned DEFAULT '0' NOT NULL,
	value_default_yes_no tinyint(3) unsigned DEFAULT '0' NOT NULL,
	value_minimum int(11) DEFAULT '0',
	value_maximum int(11) DEFAULT '0',

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_option'
#
CREATE TABLE tx_pbsurvey_option (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	checked tinyint(1) DEFAULT '0' NOT NULL,
	label tinytext NOT NULL,
	points int(11) unsigned DEFAULT '0' NOT NULL,
	value tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY pid (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_option_predefined'
#
CREATE TABLE tx_pbsurvey_option_predefined (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	label tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY pid (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_option_predefined_group'
#
CREATE TABLE tx_pbsurvey_option_predefined_group (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

	name tinytext NOT NULL,
	options int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY pid (pid)
);

#
# Table structure for table 'tx_pbsurvey_option_row'
#
CREATE TABLE tx_pbsurvey_option_row (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	label tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY pid (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_page'
#
CREATE TABLE tx_pbsurvey_page (
	uid int(11) DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(10) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	condition_groups text NOT NULL,

	introduction text NOT NULL,
	items int(11) unsigned DEFAULT '0' NOT NULL,
	title tinytext NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_pbsurvey_page_condition_group'
#
CREATE TABLE tx_pbsurvey_page_condition_group (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(10) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	name tinytext NOT NULL,
	rules int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY pid (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_page_condition_rule'
#
CREATE TABLE tx_pbsurvey_page_condition_rule (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(10) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	item int(11) unsigned DEFAULT '0' NOT NULL,
	item_option int(11) unsigned DEFAULT '0' NOT NULL,
	item_option_additional tinytext NOT NULL,
	name tinytext NOT NULL,
	operator varchar(6) NOT NULL DEFAULT '',

	PRIMARY KEY (uid),
	KEY pid (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_result'
#
CREATE TABLE tx_pbsurvey_result (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

	fe_user int(11) unsigned DEFAULT '0' NOT NULL,
	finished tinyint(4) unsigned DEFAULT '0' NOT NULL,
	ip varchar(78) NOT NULL DEFAULT '',
	language_uid int(11) unsigned DEFAULT '0' NOT NULL,
	stages int(11) unsigned DEFAULT '0' NOT NULL,
	timestamp_begin int(11) unsigned DEFAULT '0' NOT NULL,
	timestamp_end int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tx_pbsurvey_score'
#
CREATE TABLE tx_pbsurvey_score (
	uid int(11) unsigned NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	page int(11) unsigned DEFAULT '0' NOT NULL,
	score int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY pid (pid),
	KEY parentid (parentid)
);

#
# Table structure for table 'tx_pbsurvey_stage'
#
CREATE TABLE tx_pbsurvey_stage (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,

	crdate int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(10) unsigned DEFAULT '0' NOT NULL,

	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,

	answers int(11) unsigned DEFAULT '0' NOT NULL,
	page int(11) unsigned DEFAULT '0' NOT NULL,

	parentid int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY parent (parentid)
);