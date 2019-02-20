SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Un commentateur WordPress', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2019-01-18 16:16:22', '2019-01-18 15:16:22', 'Bonjour, ceci est un commentaire.\nPour débuter avec la modération, la modification et la suppression de commentaires, veuillez visiter l’écran des Commentaires dans le Tableau de bord.\nLes avatars des personnes qui commentent arrivent depuis <a href="https://gravatar.com">Gravatar</a>.', 0, '1', '', '', 0, 0);

CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'https://wordpress.camency.fr', 'yes'),
(2, 'home', 'https://wordpress.camency.fr', 'yes'),
(3, 'blogname', 'Wordpress', 'yes'),
(4, 'blogdescription', 'Un site utilisant WordPress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'admin@wordpress.fr', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '0', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'j F Y', 'yes'),
(24, 'time_format', 'G \\h i \\m\\i\\n', 'yes'),
(25, 'links_updated_date_format', 'j F Y G \\h i \\m\\i\\n', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:0:{}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', 'a:3:{i:0;s:80:"/Applications/MAMP/htdocs/wordpress/wp-content/plugins/akismet/class.akismet.php";i:1;s:74:"/Applications/MAMP/htdocs/wordpress/wp-content/plugins/akismet/akismet.php";i:2;s:0:"";}', 'no'),
(40, 'template', 'bulk', 'yes'),
(41, 'stylesheet', 'bulk-blog', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '43764', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '0', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(79, 'widget_text', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(80, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', 'Europe/Paris', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'show_comments_cookies_opt_in', '0', 'yes'),
(93, 'initial_db_version', '43764', 'yes'),
(94, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:77:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:23:"rank_math_edit_htaccess";b:1;s:16:"rank_math_titles";b:1;s:17:"rank_math_general";b:1;s:17:"rank_math_sitemap";b:1;s:21:"rank_math_404_monitor";b:1;s:22:"rank_math_link_builder";b:1;s:22:"rank_math_redirections";b:1;s:22:"rank_math_role_manager";b:1;s:24:"rank_math_search_console";b:1;s:23:"rank_math_site_analysis";b:1;s:25:"rank_math_onpage_analysis";b:1;s:24:"rank_math_onpage_general";b:1;s:25:"rank_math_onpage_advanced";b:1;s:24:"rank_math_onpage_snippet";b:1;s:23:"rank_math_onpage_social";b:1;s:19:"rank_math_admin_bar";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:39:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:23:"rank_math_site_analysis";b:1;s:25:"rank_math_onpage_analysis";b:1;s:24:"rank_math_onpage_general";b:1;s:24:"rank_math_onpage_snippet";b:1;s:23:"rank_math_onpage_social";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:14:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;s:25:"rank_math_onpage_analysis";b:1;s:24:"rank_math_onpage_general";b:1;s:24:"rank_math_onpage_snippet";b:1;s:23:"rank_math_onpage_social";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:8:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:25:"rank_math_onpage_analysis";b:1;s:24:"rank_math_onpage_general";b:1;s:23:"rank_math_onpage_social";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:5:{s:4:"read";b:1;s:7:"level_0";b:1;s:25:"rank_math_onpage_analysis";b:1;s:24:"rank_math_onpage_general";b:1;s:23:"rank_math_onpage_social";b:1;}}}', 'yes'),
(95, 'fresh_site', '0', 'yes'),
(96, 'WPLANG', 'fr_FR', 'yes'),
(97, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(99, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(100, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(101, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(102, 'sidebars_widgets', 'a:5:{s:19:"wp_inactive_widgets";a:0:{}s:18:"bulk-right-sidebar";a:0:{}s:16:"bulk-footer-area";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:13:"array_version";i:3;}', 'yes'),
(103, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(104, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(105, 'widget_media_audio', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(106, 'widget_media_image', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(107, 'widget_media_gallery', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(108, 'widget_media_video', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(109, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(110, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(111, 'widget_custom_html', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(112, 'cron', 'a:6:{i:1548857783;a:1:{s:34:"wp_privacy_delete_old_export_files";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"hourly";s:4:"args";a:0:{}s:8:"interval";i:3600;}}}i:1548861383;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1548861401;a:2:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}s:25:"delete_expired_transients";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1548861746;a:1:{s:19:"wpseo-reindex-links";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1548892800;a:3:{s:38:"rank_math/search_console/get_analytics";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}s:35:"rank_math/redirection/clean_trashed";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}s:30:"rank_math/links/internal_links";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(113, 'theme_mods_twentynineteen', 'a:2:{s:18:"custom_css_post_id";i:-1;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1547824732;s:4:"data";a:2:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}}}}', 'yes'),
(139, 'can_compress_scripts', '1', 'no'),
(143, 'widget_vw_one_page_social_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(144, 'theme_mods_vw-one-page', 'a:1:{s:18:"custom_css_post_id";i:-1;}', 'yes'),
(151, 'theme_mods_bulk-blog', 'a:1:{s:18:"custom_css_post_id";i:-1;}', 'yes'),
(152, 'current_theme', 'Bulk Blog', 'yes'),
(153, 'theme_switched', '', 'yes'),
(154, 'theme_switched_via_customizer', '', 'yes'),
(155, 'customize_stashed_theme_mods', 'a:0:{}', 'no'),
(166, 'recently_activated', 'a:2:{s:24:"wordpress-seo/wp-seo.php";i:1547836116;s:35:"autodescription/autodescription.php";i:1547836104;}', 'yes'),
(173, 'wpseo', 'a:20:{s:15:"ms_defaults_set";b:0;s:7:"version";s:3:"9.4";s:20:"disableadvanced_meta";b:1;s:19:"onpage_indexability";b:1;s:11:"baiduverify";s:0:"";s:12:"googleverify";s:0:"";s:8:"msverify";s:0:"";s:12:"yandexverify";s:0:"";s:9:"site_type";s:0:"";s:20:"has_multiple_authors";s:0:"";s:16:"environment_type";s:0:"";s:23:"content_analysis_active";b:1;s:23:"keyword_analysis_active";b:1;s:21:"enable_admin_bar_menu";b:1;s:26:"enable_cornerstone_content";b:1;s:18:"enable_xml_sitemap";b:1;s:24:"enable_text_link_counter";b:1;s:22:"show_onboarding_notice";b:1;s:18:"first_activated_on";i:1547824945;s:18:"recalibration_beta";b:0;}', 'yes'),
(174, 'wpseo_titles', 'a:67:{s:10:"title_test";i:0;s:17:"forcerewritetitle";b:0;s:9:"separator";s:7:"sc-dash";s:16:"title-home-wpseo";s:42:"%%sitename%% %%page%% %%sep%% %%sitedesc%%";s:18:"title-author-wpseo";s:42:"%%name%%, auteur sur %%sitename%% %%page%%";s:19:"title-archive-wpseo";s:38:"%%date%% %%page%% %%sep%% %%sitename%%";s:18:"title-search-wpseo";s:65:"Vous avez cherché %%searchphrase%% %%page%% %%sep%% %%sitename%%";s:15:"title-404-wpseo";s:38:"Page non trouvée %%sep%% %%sitename%%";s:19:"metadesc-home-wpseo";s:0:"";s:21:"metadesc-author-wpseo";s:0:"";s:22:"metadesc-archive-wpseo";s:0:"";s:9:"rssbefore";s:0:"";s:8:"rssafter";s:64:"L’article %%POSTLINK%% est apparu en premier sur %%BLOGLINK%%.";s:20:"noindex-author-wpseo";b:0;s:28:"noindex-author-noposts-wpseo";b:1;s:21:"noindex-archive-wpseo";b:1;s:14:"disable-author";b:0;s:12:"disable-date";b:0;s:19:"disable-post_format";b:0;s:18:"disable-attachment";b:1;s:23:"is-media-purge-relevant";b:0;s:20:"breadcrumbs-404crumb";s:30:"Erreur 404 : Page introuvable";s:29:"breadcrumbs-display-blog-page";b:1;s:20:"breadcrumbs-boldlast";b:0;s:25:"breadcrumbs-archiveprefix";s:13:"Archives pour";s:18:"breadcrumbs-enable";b:0;s:16:"breadcrumbs-home";s:7:"Accueil";s:18:"breadcrumbs-prefix";s:0:"";s:24:"breadcrumbs-searchprefix";s:18:"Vous avez cherché";s:15:"breadcrumbs-sep";s:7:"&raquo;";s:12:"website_name";s:0:"";s:11:"person_name";s:0:"";s:22:"alternate_website_name";s:0:"";s:12:"company_logo";s:0:"";s:12:"company_name";s:0:"";s:17:"company_or_person";s:0:"";s:17:"stripcategorybase";b:0;s:10:"title-post";s:39:"%%title%% %%page%% %%sep%% %%sitename%%";s:13:"metadesc-post";s:0:"";s:12:"noindex-post";b:0;s:13:"showdate-post";b:0;s:23:"display-metabox-pt-post";b:1;s:23:"post_types-post-maintax";i:0;s:10:"title-page";s:39:"%%title%% %%page%% %%sep%% %%sitename%%";s:13:"metadesc-page";s:0:"";s:12:"noindex-page";b:0;s:13:"showdate-page";b:0;s:23:"display-metabox-pt-page";b:1;s:23:"post_types-page-maintax";i:0;s:16:"title-attachment";s:39:"%%title%% %%page%% %%sep%% %%sitename%%";s:19:"metadesc-attachment";s:0:"";s:18:"noindex-attachment";b:0;s:19:"showdate-attachment";b:0;s:29:"display-metabox-pt-attachment";b:1;s:29:"post_types-attachment-maintax";i:0;s:18:"title-tax-category";s:57:"Archives des %%term_title%% %%page%% %%sep%% %%sitename%%";s:21:"metadesc-tax-category";s:0:"";s:28:"display-metabox-tax-category";b:1;s:20:"noindex-tax-category";b:0;s:18:"title-tax-post_tag";s:57:"Archives des %%term_title%% %%page%% %%sep%% %%sitename%%";s:21:"metadesc-tax-post_tag";s:0:"";s:28:"display-metabox-tax-post_tag";b:1;s:20:"noindex-tax-post_tag";b:0;s:21:"title-tax-post_format";s:57:"Archives des %%term_title%% %%page%% %%sep%% %%sitename%%";s:24:"metadesc-tax-post_format";s:0:"";s:31:"display-metabox-tax-post_format";b:1;s:23:"noindex-tax-post_format";b:1;}', 'yes'),
(175, 'wpseo_social', 'a:20:{s:13:"facebook_site";s:0:"";s:13:"instagram_url";s:0:"";s:12:"linkedin_url";s:0:"";s:11:"myspace_url";s:0:"";s:16:"og_default_image";s:0:"";s:19:"og_default_image_id";s:0:"";s:18:"og_frontpage_title";s:0:"";s:17:"og_frontpage_desc";s:0:"";s:18:"og_frontpage_image";s:0:"";s:21:"og_frontpage_image_id";s:0:"";s:9:"opengraph";b:1;s:13:"pinterest_url";s:0:"";s:15:"pinterestverify";s:0:"";s:14:"plus-publisher";s:0:"";s:7:"twitter";b:1;s:12:"twitter_site";s:0:"";s:17:"twitter_card_type";s:19:"summary_large_image";s:11:"youtube_url";s:0:"";s:15:"google_plus_url";s:0:"";s:10:"fbadminapp";s:0:"";}', 'yes'),
(176, 'wpseo_flush_rewrite', '1', 'yes'),
(177, '_transient_timeout_wpseo_link_table_inaccessible', '1579360946', 'no'),
(178, '_transient_wpseo_link_table_inaccessible', '0', 'no'),
(179, '_transient_timeout_wpseo_meta_table_inaccessible', '1579360946', 'no'),
(180, '_transient_wpseo_meta_table_inaccessible', '0', 'no'),
(216, 'rewrite_rules', 'a:93:{s:19:"sitemap_index\\.xml$";s:19:"index.php?sitemap=1";s:31:"([^/]+?)-sitemap([0-9]+)?\\.xml$";s:51:"index.php?sitemap=$matches[1]&sitemap_n=$matches[2]";s:24:"([a-z]+)?-?sitemap\\.xsl$";s:25:"index.php?xsl=$matches[1]";s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:21:"^index.php/wp-json/?$";s:22:"index.php?rest_route=/";s:24:"^index.php/wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:23:"category/(.+?)/embed/?$";s:46:"index.php?category_name=$matches[1]&embed=true";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:20:"tag/([^/]+)/embed/?$";s:36:"index.php?tag=$matches[1]&embed=true";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:21:"type/([^/]+)/embed/?$";s:44:"index.php?post_format=$matches[1]&embed=true";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:12:"robots\\.txt$";s:18:"index.php?robots=1";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:8:"embed/?$";s:21:"index.php?&embed=true";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:17:"comments/embed/?$";s:21:"index.php?&embed=true";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:20:"search/(.+)/embed/?$";s:34:"index.php?s=$matches[1]&embed=true";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:23:"author/([^/]+)/embed/?$";s:44:"index.php?author_name=$matches[1]&embed=true";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:45:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$";s:74:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:32:"([0-9]{4})/([0-9]{1,2})/embed/?$";s:58:"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:19:"([0-9]{4})/embed/?$";s:37:"index.php?year=$matches[1]&embed=true";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:53:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$";s:91:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:61:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:53:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes'),
(257, 'rank_math_search_console_data', 'a:2:{s:10:"authorized";b:0;s:8:"profiles";a:0:{}}', 'yes'),
(258, 'rank_math_known_post_types', 'a:3:{s:4:"post";s:4:"post";s:4:"page";s:4:"page";s:10:"attachment";s:10:"attachment";}', 'yes'),
(259, 'rank_math_modules', 'a:6:{i:0;s:12:"link-counter";i:1;s:14:"search-console";i:2;s:12:"seo-analysis";i:3;s:7:"sitemap";i:4;s:12:"rich-snippet";i:5;s:11:"woocommerce";}', 'yes'),
(260, 'rank-math-options-general', 'a:35:{s:19:"strip_category_base";s:3:"off";s:24:"attachment_redirect_urls";s:2:"on";s:27:"attachment_redirect_default";s:21:"https://wordpress.camency.fr";s:19:"url_strip_stopwords";s:3:"off";s:23:"nofollow_external_links";s:3:"off";s:20:"nofollow_image_links";s:2:"on";s:25:"new_window_external_links";s:2:"on";s:11:"add_img_alt";s:3:"off";s:14:"img_alt_format";s:20:"%title% %count(alt)%";s:13:"add_img_title";s:3:"off";s:16:"img_title_format";s:22:"%title% %count(title)%";s:11:"breadcrumbs";s:3:"off";s:21:"breadcrumbs_separator";s:1:"-";s:16:"breadcrumbs_home";s:2:"on";s:22:"breadcrumbs_home_label";s:4:"Home";s:26:"breadcrumbs_archive_format";s:15:"Archives for %s";s:25:"breadcrumbs_search_format";s:14:"Results for %s";s:21:"breadcrumbs_404_label";s:25:"404 Error: page not found";s:31:"breadcrumbs_ancestor_categories";s:3:"off";s:16:"404_monitor_mode";s:6:"simple";s:17:"404_monitor_limit";i:100;s:35:"404_monitor_ignore_query_parameters";s:2:"on";s:24:"redirections_header_code";s:3:"301";s:18:"redirections_debug";s:3:"off";s:15:"console_profile";s:0:"";s:23:"console_caching_control";s:2:"90";s:27:"link_builder_links_per_page";s:1:"7";s:29:"link_builder_links_per_target";s:1:"1";s:22:"wc_remove_product_base";s:3:"off";s:23:"wc_remove_category_base";s:3:"off";s:31:"wc_remove_category_parent_slugs";s:3:"off";s:18:"rss_before_content";s:0:"";s:17:"rss_after_content";s:0:"";s:14:"usage_tracking";s:2:"on";s:19:"wc_remove_generator";s:2:"on";}', 'yes'),
(261, 'rank-math-options-titles', 'a:85:{s:24:"noindex_empty_taxonomies";s:2:"on";s:15:"title_separator";s:1:"-";s:17:"capitalize_titles";s:3:"off";s:17:"twitter_card_type";s:19:"summary_large_image";s:19:"knowledgegraph_type";s:6:"person";s:19:"knowledgegraph_name";s:9:"Wordpress";s:19:"local_business_type";s:12:"Organization";s:20:"local_address_format";s:43:"{address} {locality}, {region} {postalcode}";s:13:"opening_hours";a:7:{i:0;a:2:{s:3:"day";s:6:"Monday";s:4:"time";s:11:"09:00-17:00";}i:1;a:2:{s:3:"day";s:7:"Tuesday";s:4:"time";s:11:"09:00-17:00";}i:2;a:2:{s:3:"day";s:9:"Wednesday";s:4:"time";s:11:"09:00-17:00";}i:3;a:2:{s:3:"day";s:8:"Thursday";s:4:"time";s:11:"09:00-17:00";}i:4;a:2:{s:3:"day";s:6:"Friday";s:4:"time";s:11:"09:00-17:00";}i:5;a:2:{s:3:"day";s:8:"Saturday";s:4:"time";s:11:"09:00-17:00";}i:6;a:2:{s:3:"day";s:6:"Sunday";s:4:"time";s:11:"09:00-17:00";}}s:20:"opening_hours_format";s:3:"off";s:14:"homepage_title";s:34:"%sitename% %page% %sep% %sitedesc%";s:20:"homepage_description";s:0:"";s:22:"homepage_custom_robots";s:3:"off";s:23:"disable_author_archives";s:2:"on";s:15:"url_author_base";s:6:"author";s:22:"noindex_author_archive";s:3:"off";s:20:"author_archive_title";s:30:"%name% %sep% %sitename% %page%";s:19:"author_add_meta_box";s:2:"on";s:21:"disable_date_archives";s:3:"off";s:18:"date_archive_title";s:30:"%date% %page% %sep% %sitename%";s:12:"search_title";s:38:"%search_query% %page% %sep% %sitename%";s:9:"404_title";s:31:"Page Not Found %sep% %sitename%";s:12:"noindex_date";s:2:"on";s:14:"noindex_search";s:2:"on";s:24:"noindex_archive_subpages";s:3:"off";s:26:"noindex_password_protected";s:3:"off";s:13:"pt_post_title";s:24:"%title% %sep% %sitename%";s:19:"pt_post_description";s:9:"%excerpt%";s:14:"pt_post_robots";a:0:{}s:21:"pt_post_custom_robots";s:3:"off";s:28:"pt_post_default_rich_snippet";s:7:"article";s:28:"pt_post_default_article_type";s:11:"BlogPosting";s:28:"pt_post_default_snippet_name";s:7:"%title%";s:28:"pt_post_default_snippet_desc";s:9:"%excerpt%";s:17:"pt_post_ls_use_fk";s:6:"titles";s:20:"pt_post_add_meta_box";s:2:"on";s:20:"pt_post_bulk_editing";s:7:"editing";s:24:"pt_post_link_suggestions";s:2:"on";s:24:"pt_post_primary_taxonomy";s:8:"category";s:13:"pt_page_title";s:24:"%title% %sep% %sitename%";s:19:"pt_page_description";s:9:"%excerpt%";s:14:"pt_page_robots";a:0:{}s:21:"pt_page_custom_robots";s:3:"off";s:28:"pt_page_default_rich_snippet";s:7:"article";s:28:"pt_page_default_article_type";s:7:"Article";s:28:"pt_page_default_snippet_name";s:7:"%title%";s:28:"pt_page_default_snippet_desc";s:9:"%excerpt%";s:17:"pt_page_ls_use_fk";s:6:"titles";s:20:"pt_page_add_meta_box";s:2:"on";s:20:"pt_page_bulk_editing";s:7:"editing";s:24:"pt_page_link_suggestions";s:2:"on";s:19:"pt_attachment_title";s:24:"%title% %sep% %sitename%";s:25:"pt_attachment_description";s:9:"%excerpt%";s:20:"pt_attachment_robots";a:1:{i:0;s:7:"noindex";}s:27:"pt_attachment_custom_robots";s:2:"on";s:34:"pt_attachment_default_rich_snippet";s:3:"off";s:34:"pt_attachment_default_article_type";s:7:"Article";s:34:"pt_attachment_default_snippet_name";s:7:"%title%";s:34:"pt_attachment_default_snippet_desc";s:9:"%excerpt%";s:26:"pt_attachment_add_meta_box";s:3:"off";s:16:"pt_product_title";s:24:"%title% %sep% %sitename%";s:22:"pt_product_description";s:9:"%excerpt%";s:17:"pt_product_robots";a:0:{}s:24:"pt_product_custom_robots";s:3:"off";s:31:"pt_product_default_rich_snippet";s:7:"product";s:31:"pt_product_default_article_type";s:7:"Article";s:31:"pt_product_default_snippet_name";s:7:"%title%";s:31:"pt_product_default_snippet_desc";s:9:"%excerpt%";s:20:"pt_product_ls_use_fk";s:6:"titles";s:23:"pt_product_add_meta_box";s:2:"on";s:23:"pt_product_bulk_editing";s:7:"editing";s:27:"pt_product_link_suggestions";s:2:"on";s:27:"pt_product_primary_taxonomy";s:11:"product_cat";s:18:"tax_category_title";s:23:"%term% %sep% %sitename%";s:19:"tax_category_robots";a:0:{}s:25:"tax_category_add_meta_box";s:2:"on";s:26:"tax_category_custom_robots";s:3:"off";s:18:"tax_post_tag_title";s:23:"%term% %sep% %sitename%";s:19:"tax_post_tag_robots";a:1:{i:0;s:7:"noindex";}s:25:"tax_post_tag_add_meta_box";s:3:"off";s:26:"tax_post_tag_custom_robots";s:2:"on";s:21:"tax_post_format_title";s:23:"%term% %sep% %sitename%";s:22:"tax_post_format_robots";a:1:{i:0;s:7:"noindex";}s:28:"tax_post_format_add_meta_box";s:3:"off";s:29:"tax_post_format_custom_robots";s:2:"on";}', 'yes'),
(262, 'rank-math-options-sitemap', 'a:12:{s:14:"items_per_page";i:1000;s:14:"include_images";s:2:"on";s:22:"include_featured_image";s:3:"off";s:19:"ping_search_engines";s:2:"on";s:13:"exclude_roles";a:4:{s:11:"contributor";s:11:"Contributor";s:10:"subscriber";s:10:"Subscriber";s:13:"wpseo_manager";s:11:"SEO Manager";s:12:"wpseo_editor";s:10:"SEO Editor";}s:15:"pt_post_sitemap";s:2:"on";s:15:"pt_page_sitemap";s:2:"on";s:21:"pt_attachment_sitemap";s:3:"off";s:18:"pt_product_sitemap";s:2:"on";s:20:"tax_category_sitemap";s:2:"on";s:20:"tax_post_tag_sitemap";s:3:"off";s:23:"tax_post_format_sitemap";s:3:"off";}', 'yes'),
(265, 'rank_math_version', '1.0.12', 'yes'),
(266, 'rank_math_db_version', '1', 'yes'),
(267, 'rank_math_install_date', '1547839671', 'yes'),
(268, 'rank_math_flush_rewrite', '1', 'yes'),
(269, 'the_seo_framework_tested_upgrade_version', '3104', 'yes'),
(270, 'autodescription-updates-cache', 'a:1:{s:26:"check_seo_plugin_conflicts";i:0;}', 'yes'),
(271, 'the_seo_framework_initial_db_version', '3104', 'no'),
(272, 'autodescription-site-settings', 'a:112:{s:18:"alter_search_query";i:1;s:19:"alter_archive_query";i:1;s:24:"alter_archive_query_type";s:8:"in_query";s:23:"alter_search_query_type";s:8:"in_query";s:17:"cache_meta_schema";i:0;s:13:"cache_sitemap";i:1;s:12:"cache_object";i:1;s:22:"display_seo_bar_tables";i:1;s:23:"display_seo_bar_metabox";i:0;s:21:"display_pixel_counter";i:1;s:25:"display_character_counter";i:1;s:16:"canonical_scheme";s:9:"automatic";s:17:"timestamps_format";s:1:"1";s:19:"disabled_post_types";a:0:{}s:15:"title_separator";s:4:"pipe";s:14:"title_location";s:5:"right";s:19:"title_rem_additions";i:0;s:18:"title_rem_prefixes";i:0;s:16:"title_strip_tags";i:1;s:16:"auto_description";i:1;s:16:"category_noindex";i:0;s:11:"tag_noindex";i:0;s:14:"author_noindex";i:0;s:12:"date_noindex";i:1;s:14:"search_noindex";i:1;s:18:"attachment_noindex";i:1;s:12:"site_noindex";i:0;s:18:"noindex_post_types";a:1:{s:10:"attachment";i:1;}s:17:"category_nofollow";i:0;s:12:"tag_nofollow";i:0;s:15:"author_nofollow";i:0;s:13:"date_nofollow";i:0;s:15:"search_nofollow";i:0;s:19:"attachment_nofollow";i:0;s:13:"site_nofollow";i:0;s:19:"nofollow_post_types";a:0:{}s:18:"category_noarchive";i:0;s:13:"tag_noarchive";i:0;s:16:"author_noarchive";i:0;s:14:"date_noarchive";i:0;s:16:"search_noarchive";i:0;s:20:"attachment_noarchive";i:0;s:14:"site_noarchive";i:0;s:20:"noarchive_post_types";a:0:{}s:13:"paged_noindex";i:1;s:18:"home_paged_noindex";i:0;s:16:"homepage_noindex";i:0;s:17:"homepage_nofollow";i:0;s:18:"homepage_noarchive";i:0;s:14:"homepage_title";s:0:"";s:16:"homepage_tagline";i:1;s:20:"homepage_description";s:0:"";s:22:"homepage_title_tagline";s:0:"";s:19:"home_title_location";s:4:"left";s:17:"homepage_og_title";s:0:"";s:23:"homepage_og_description";s:0:"";s:22:"homepage_twitter_title";s:0:"";s:28:"homepage_twitter_description";s:0:"";s:25:"homepage_social_image_url";s:0:"";s:24:"homepage_social_image_id";i:0;s:13:"shortlink_tag";i:0;s:15:"prev_next_posts";i:1;s:18:"prev_next_archives";i:1;s:19:"prev_next_frontpage";i:1;s:18:"facebook_publisher";s:0:"";s:15:"facebook_author";s:0:"";s:14:"facebook_appid";s:0:"";s:17:"post_publish_time";i:1;s:16:"post_modify_time";i:1;s:12:"twitter_card";s:19:"summary_large_image";s:12:"twitter_site";s:0:"";s:15:"twitter_creator";s:0:"";s:7:"og_tags";i:1;s:13:"facebook_tags";i:1;s:12:"twitter_tags";i:1;s:19:"social_image_fb_url";s:0:"";s:18:"social_image_fb_id";i:0;s:19:"google_verification";s:0:"";s:17:"bing_verification";s:0:"";s:19:"yandex_verification";s:0:"";s:17:"pint_verification";s:0:"";s:16:"knowledge_output";i:1;s:14:"knowledge_type";s:12:"organization";s:14:"knowledge_logo";i:1;s:14:"knowledge_name";s:0:"";s:18:"knowledge_logo_url";s:0:"";s:17:"knowledge_logo_id";i:0;s:18:"knowledge_facebook";s:0:"";s:17:"knowledge_twitter";s:0:"";s:15:"knowledge_gplus";s:0:"";s:19:"knowledge_instagram";s:0:"";s:17:"knowledge_youtube";s:0:"";s:18:"knowledge_linkedin";s:0:"";s:19:"knowledge_pinterest";s:0:"";s:20:"knowledge_soundcloud";s:0:"";s:16:"knowledge_tumblr";s:0:"";s:15:"sitemaps_output";i:1;s:19:"sitemap_query_limit";i:1200;s:17:"sitemaps_modified";i:1;s:17:"sitemaps_priority";i:0;s:15:"sitemaps_robots";i:1;s:11:"ping_google";i:1;s:9:"ping_bing";i:1;s:11:"ping_yandex";i:1;s:14:"sitemap_styles";i:1;s:12:"sitemap_logo";i:1;s:18:"sitemap_color_main";s:3:"333";s:20:"sitemap_color_accent";s:6:"00cd98";s:16:"excerpt_the_feed";i:1;s:15:"source_the_feed";i:1;s:17:"ld_json_searchbox";i:1;s:19:"ld_json_breadcrumbs";i:1;}', 'no'),
(273, 'the_seo_framework_upgraded_db_version', '3104', 'yes'),
(302, '_site_transient_timeout_theme_roots', '1548850975', 'no'),
(303, '_site_transient_theme_roots', 'a:8:{s:9:"bulk-blog";s:7:"/themes";s:4:"bulk";s:7:"/themes";s:7:"islemag";s:7:"/themes";s:14:"twentynineteen";s:7:"/themes";s:15:"twentyseventeen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";s:11:"vw-one-page";s:7:"/themes";s:4:"yoko";s:7:"/themes";}', 'no'),
(305, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:65:"https://downloads.wordpress.org/release/fr_FR/wordpress-5.0.3.zip";s:6:"locale";s:5:"fr_FR";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:65:"https://downloads.wordpress.org/release/fr_FR/wordpress-5.0.3.zip";s:10:"no_content";b:0;s:11:"new_bundled";b:0;s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"5.0.3";s:7:"version";s:5:"5.0.3";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"5.0";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1548849178;s:15:"version_checked";s:5:"5.0.3";s:12:"translations";a:1:{i:0;a:7:{s:4:"type";s:4:"core";s:4:"slug";s:7:"default";s:8:"language";s:5:"fr_FR";s:7:"version";s:5:"5.0.3";s:7:"updated";s:19:"2019-01-25 09:32:29";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/5.0.3/fr_FR.zip";s:10:"autoupdate";b:1;}}}', 'no'),
(306, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1548849179;s:7:"checked";a:8:{s:9:"bulk-blog";s:5:"1.0.2";s:4:"bulk";s:5:"1.0.8";s:7:"islemag";s:6:"1.1.14";s:14:"twentynineteen";s:3:"1.2";s:15:"twentyseventeen";s:3:"2.0";s:13:"twentysixteen";s:3:"1.8";s:11:"vw-one-page";s:3:"0.1";s:4:"yoko";s:5:"1.2.4";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'no');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(307, '_site_transient_update_plugins', 'O:8:"stdClass":5:{s:12:"last_checked";i:1548849180;s:7:"checked";a:40:{s:53:"accelerated-mobile-pages/accelerated-moblie-pages.php";s:9:"0.9.97.25";s:57:"acf-content-analysis-for-yoast-seo/yoast-acf-analysis.php";s:5:"2.1.0";s:19:"akismet/akismet.php";s:3:"4.1";s:51:"all-in-one-wp-migration/all-in-one-wp-migration.php";s:4:"6.83";s:43:"all-in-one-seo-pack/all_in_one_seo_pack.php";s:6:"2.10.1";s:27:"wp-asset-clean-up/wpacu.php";s:7:"1.2.9.1";s:27:"autoptimize/autoptimize.php";s:5:"2.4.4";s:39:"boldgrid-easy-seo/boldgrid-easy-seo.php";s:5:"1.6.0";s:55:"ecommerce-product-catalog/ecommerce-product-catalog.php";s:6:"2.8.24";s:23:"elementor/elementor.php";s:5:"2.4.1";s:19:"fenshop/FenShop.php";s:6:"1.13.2";s:21:"fotomoto/fotomoto.php";s:5:"1.2.1";s:9:"hello.php";s:5:"1.7.1";s:21:"hello-dolly/hello.php";s:3:"1.6";s:23:"instashop/instashop.php";s:5:"1.2.0";s:19:"jetpack/jetpack.php";s:3:"6.9";s:35:"litespeed-cache/litespeed-cache.php";s:3:"2.9";s:23:"ml-slider/ml-slider.php";s:6:"3.10.3";s:27:"ninja-forms/ninja-forms.php";s:5:"3.4.2";s:23:"payfacile/payfacile.php";s:5:"1.0.1";s:45:"paygreen-woocommerce/paygreen-woocommerce.php";s:5:"2.1.6";s:30:"seo-by-rank-math/rank-math.php";s:6:"1.0.12";s:19:"refiral/refiral.php";s:3:"1.0";s:27:"seo-booster/seo-booster.php";s:5:"3.4.7";s:24:"wp-seopress/seopress.php";s:5:"3.3.6";s:23:"wp-smushit/wp-smush.php";s:5:"3.0.2";s:21:"squareoffs/plugin.php";s:5:"1.1.0";s:35:"autodescription/autodescription.php";s:5:"3.2.1";s:27:"woocommerce/woocommerce.php";s:5:"3.5.3";s:43:"woocommerce-payplug/woocommerce-payplug.php";s:5:"3.1.0";s:23:"wordfence/wordfence.php";s:6:"7.1.20";s:41:"wordpress-importer/wordpress-importer.php";s:5:"0.6.4";s:17:"wpshop/wpshop.php";s:5:"1.6.1";s:51:"wp-e-commerce-cheques-virement-bancaires/loader.php";s:5:"1.0.4";s:35:"wp-fastest-cache/wpFastestCache.php";s:7:"0.8.8.9";s:27:"wp-meta-seo/wp-meta-seo.php";s:5:"4.0.2";s:27:"wp-super-cache/wp-cache.php";s:5:"1.6.4";s:31:"xili-language/xili-language.php";s:6:"2.21.2";s:24:"wordpress-seo/wp-seo.php";s:3:"9.4";s:61:"yoast-seo-search-index-purge/yoast-seo-search-index-purge.php";s:5:"1.1.0";}s:8:"response";a:14:{s:53:"accelerated-mobile-pages/accelerated-moblie-pages.php";O:8:"stdClass":12:{s:2:"id";s:38:"w.org/plugins/accelerated-mobile-pages";s:4:"slug";s:24:"accelerated-mobile-pages";s:6:"plugin";s:53:"accelerated-mobile-pages/accelerated-moblie-pages.php";s:11:"new_version";s:9:"0.9.97.28";s:3:"url";s:55:"https://wordpress.org/plugins/accelerated-mobile-pages/";s:7:"package";s:77:"https://downloads.wordpress.org/plugin/accelerated-mobile-pages.0.9.97.28.zip";s:5:"icons";a:2:{s:2:"2x";s:77:"https://ps.w.org/accelerated-mobile-pages/assets/icon-256x256.png?rev=1693616";s:2:"1x";s:77:"https://ps.w.org/accelerated-mobile-pages/assets/icon-128x128.png?rev=1693616";}s:7:"banners";a:2:{s:2:"2x";s:80:"https://ps.w.org/accelerated-mobile-pages/assets/banner-1544x500.png?rev=1776918";s:2:"1x";s:79:"https://ps.w.org/accelerated-mobile-pages/assets/banner-772x250.png?rev=1776918";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:57:"acf-content-analysis-for-yoast-seo/yoast-acf-analysis.php";O:8:"stdClass":12:{s:2:"id";s:48:"w.org/plugins/acf-content-analysis-for-yoast-seo";s:4:"slug";s:34:"acf-content-analysis-for-yoast-seo";s:6:"plugin";s:57:"acf-content-analysis-for-yoast-seo/yoast-acf-analysis.php";s:11:"new_version";s:5:"2.2.0";s:3:"url";s:65:"https://wordpress.org/plugins/acf-content-analysis-for-yoast-seo/";s:7:"package";s:83:"https://downloads.wordpress.org/plugin/acf-content-analysis-for-yoast-seo.2.2.0.zip";s:5:"icons";a:2:{s:2:"2x";s:87:"https://ps.w.org/acf-content-analysis-for-yoast-seo/assets/icon-256x256.png?rev=1717503";s:2:"1x";s:87:"https://ps.w.org/acf-content-analysis-for-yoast-seo/assets/icon-128x128.png?rev=1717503";}s:7:"banners";a:2:{s:2:"2x";s:90:"https://ps.w.org/acf-content-analysis-for-yoast-seo/assets/banner-1544x500.png?rev=1717503";s:2:"1x";s:89:"https://ps.w.org/acf-content-analysis-for-yoast-seo/assets/banner-772x250.png?rev=1717503";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";s:5:"5.2.4";s:13:"compatibility";O:8:"stdClass":0:{}}s:43:"all-in-one-seo-pack/all_in_one_seo_pack.php";O:8:"stdClass":12:{s:2:"id";s:33:"w.org/plugins/all-in-one-seo-pack";s:4:"slug";s:19:"all-in-one-seo-pack";s:6:"plugin";s:43:"all-in-one-seo-pack/all_in_one_seo_pack.php";s:11:"new_version";s:4:"2.11";s:3:"url";s:50:"https://wordpress.org/plugins/all-in-one-seo-pack/";s:7:"package";s:67:"https://downloads.wordpress.org/plugin/all-in-one-seo-pack.2.11.zip";s:5:"icons";a:2:{s:2:"2x";s:71:"https://ps.w.org/all-in-one-seo-pack/assets/icon-256x256.png?rev=979908";s:2:"1x";s:71:"https://ps.w.org/all-in-one-seo-pack/assets/icon-128x128.png?rev=979908";}s:7:"banners";a:2:{s:2:"2x";s:75:"https://ps.w.org/all-in-one-seo-pack/assets/banner-1544x500.png?rev=1354894";s:2:"1x";s:74:"https://ps.w.org/all-in-one-seo-pack/assets/banner-772x250.png?rev=1354894";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:27:"wp-asset-clean-up/wpacu.php";O:8:"stdClass":12:{s:2:"id";s:31:"w.org/plugins/wp-asset-clean-up";s:4:"slug";s:17:"wp-asset-clean-up";s:6:"plugin";s:27:"wp-asset-clean-up/wpacu.php";s:11:"new_version";s:7:"1.2.9.6";s:3:"url";s:48:"https://wordpress.org/plugins/wp-asset-clean-up/";s:7:"package";s:68:"https://downloads.wordpress.org/plugin/wp-asset-clean-up.1.2.9.6.zip";s:5:"icons";a:2:{s:2:"2x";s:70:"https://ps.w.org/wp-asset-clean-up/assets/icon-256x256.png?rev=1981952";s:2:"1x";s:70:"https://ps.w.org/wp-asset-clean-up/assets/icon-128x128.png?rev=1981952";}s:7:"banners";a:1:{s:2:"1x";s:72:"https://ps.w.org/wp-asset-clean-up/assets/banner-772x250.png?rev=1986594";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:39:"boldgrid-easy-seo/boldgrid-easy-seo.php";O:8:"stdClass":12:{s:2:"id";s:31:"w.org/plugins/boldgrid-easy-seo";s:4:"slug";s:17:"boldgrid-easy-seo";s:6:"plugin";s:39:"boldgrid-easy-seo/boldgrid-easy-seo.php";s:11:"new_version";s:5:"1.6.1";s:3:"url";s:48:"https://wordpress.org/plugins/boldgrid-easy-seo/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/boldgrid-easy-seo.1.6.1.zip";s:5:"icons";a:2:{s:2:"2x";s:70:"https://ps.w.org/boldgrid-easy-seo/assets/icon-256x256.png?rev=1773296";s:2:"1x";s:70:"https://ps.w.org/boldgrid-easy-seo/assets/icon-128x128.png?rev=1773296";}s:7:"banners";a:2:{s:2:"2x";s:73:"https://ps.w.org/boldgrid-easy-seo/assets/banner-1544x500.png?rev=1773381";s:2:"1x";s:72:"https://ps.w.org/boldgrid-easy-seo/assets/banner-772x250.png?rev=1773381";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";s:3:"5.3";s:13:"compatibility";O:8:"stdClass":0:{}}s:55:"ecommerce-product-catalog/ecommerce-product-catalog.php";O:8:"stdClass":12:{s:2:"id";s:39:"w.org/plugins/ecommerce-product-catalog";s:4:"slug";s:25:"ecommerce-product-catalog";s:6:"plugin";s:55:"ecommerce-product-catalog/ecommerce-product-catalog.php";s:11:"new_version";s:6:"2.8.26";s:3:"url";s:56:"https://wordpress.org/plugins/ecommerce-product-catalog/";s:7:"package";s:75:"https://downloads.wordpress.org/plugin/ecommerce-product-catalog.2.8.26.zip";s:5:"icons";a:1:{s:2:"1x";s:78:"https://ps.w.org/ecommerce-product-catalog/assets/icon-128x128.png?rev=1103243";}s:7:"banners";a:1:{s:2:"1x";s:80:"https://ps.w.org/ecommerce-product-catalog/assets/banner-772x250.jpg?rev=1662948";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:23:"elementor/elementor.php";O:8:"stdClass":12:{s:2:"id";s:23:"w.org/plugins/elementor";s:4:"slug";s:9:"elementor";s:6:"plugin";s:23:"elementor/elementor.php";s:11:"new_version";s:5:"2.4.4";s:3:"url";s:40:"https://wordpress.org/plugins/elementor/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/elementor.2.4.4.zip";s:5:"icons";a:3:{s:2:"2x";s:62:"https://ps.w.org/elementor/assets/icon-256x256.png?rev=1427768";s:2:"1x";s:54:"https://ps.w.org/elementor/assets/icon.svg?rev=1426809";s:3:"svg";s:54:"https://ps.w.org/elementor/assets/icon.svg?rev=1426809";}s:7:"banners";a:2:{s:2:"2x";s:65:"https://ps.w.org/elementor/assets/banner-1544x500.png?rev=1475479";s:2:"1x";s:64:"https://ps.w.org/elementor/assets/banner-772x250.png?rev=1475479";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";s:3:"5.4";s:13:"compatibility";O:8:"stdClass":0:{}}s:35:"litespeed-cache/litespeed-cache.php";O:8:"stdClass":12:{s:2:"id";s:29:"w.org/plugins/litespeed-cache";s:4:"slug";s:15:"litespeed-cache";s:6:"plugin";s:35:"litespeed-cache/litespeed-cache.php";s:11:"new_version";s:5:"2.9.1";s:3:"url";s:46:"https://wordpress.org/plugins/litespeed-cache/";s:7:"package";s:64:"https://downloads.wordpress.org/plugin/litespeed-cache.2.9.1.zip";s:5:"icons";a:2:{s:2:"2x";s:68:"https://ps.w.org/litespeed-cache/assets/icon-256x256.png?rev=1574145";s:2:"1x";s:68:"https://ps.w.org/litespeed-cache/assets/icon-128x128.png?rev=1574145";}s:7:"banners";a:2:{s:2:"2x";s:71:"https://ps.w.org/litespeed-cache/assets/banner-1544x500.png?rev=2004397";s:2:"1x";s:70:"https://ps.w.org/litespeed-cache/assets/banner-772x250.png?rev=2004393";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:30:"seo-by-rank-math/rank-math.php";O:8:"stdClass":12:{s:2:"id";s:30:"w.org/plugins/seo-by-rank-math";s:4:"slug";s:16:"seo-by-rank-math";s:6:"plugin";s:30:"seo-by-rank-math/rank-math.php";s:11:"new_version";s:6:"1.0.14";s:3:"url";s:47:"https://wordpress.org/plugins/seo-by-rank-math/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/seo-by-rank-math.1.0.14.zip";s:5:"icons";a:3:{s:2:"2x";s:69:"https://ps.w.org/seo-by-rank-math/assets/icon-256x256.png?rev=1976933";s:2:"1x";s:61:"https://ps.w.org/seo-by-rank-math/assets/icon.svg?rev=1976966";s:3:"svg";s:61:"https://ps.w.org/seo-by-rank-math/assets/icon.svg?rev=1976966";}s:7:"banners";a:2:{s:2:"2x";s:72:"https://ps.w.org/seo-by-rank-math/assets/banner-1544x500.png?rev=1979395";s:2:"1x";s:71:"https://ps.w.org/seo-by-rank-math/assets/banner-772x250.png?rev=1979395";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";s:3:"5.6";s:13:"compatibility";O:8:"stdClass":0:{}}s:35:"autodescription/autodescription.php";O:8:"stdClass":12:{s:2:"id";s:29:"w.org/plugins/autodescription";s:4:"slug";s:15:"autodescription";s:6:"plugin";s:35:"autodescription/autodescription.php";s:11:"new_version";s:5:"3.2.2";s:3:"url";s:46:"https://wordpress.org/plugins/autodescription/";s:7:"package";s:64:"https://downloads.wordpress.org/plugin/autodescription.3.2.2.zip";s:5:"icons";a:3:{s:2:"2x";s:68:"https://ps.w.org/autodescription/assets/icon-256x256.png?rev=1579478";s:2:"1x";s:60:"https://ps.w.org/autodescription/assets/icon.svg?rev=1956401";s:3:"svg";s:60:"https://ps.w.org/autodescription/assets/icon.svg?rev=1956401";}s:7:"banners";a:2:{s:2:"2x";s:71:"https://ps.w.org/autodescription/assets/banner-1544x500.png?rev=1579478";s:2:"1x";s:70:"https://ps.w.org/autodescription/assets/banner-772x250.png?rev=1579478";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.4";s:12:"requires_php";s:5:"5.4.0";s:13:"compatibility";O:8:"stdClass":0:{}}s:27:"woocommerce/woocommerce.php";O:8:"stdClass":12:{s:2:"id";s:25:"w.org/plugins/woocommerce";s:4:"slug";s:11:"woocommerce";s:6:"plugin";s:27:"woocommerce/woocommerce.php";s:11:"new_version";s:5:"3.5.4";s:3:"url";s:42:"https://wordpress.org/plugins/woocommerce/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/woocommerce.3.5.4.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/woocommerce/assets/icon-256x256.png?rev=1440831";s:2:"1x";s:64:"https://ps.w.org/woocommerce/assets/icon-128x128.png?rev=1440831";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=1629184";s:2:"1x";s:66:"https://ps.w.org/woocommerce/assets/banner-772x250.png?rev=1629184";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:35:"wp-fastest-cache/wpFastestCache.php";O:8:"stdClass":12:{s:2:"id";s:30:"w.org/plugins/wp-fastest-cache";s:4:"slug";s:16:"wp-fastest-cache";s:6:"plugin";s:35:"wp-fastest-cache/wpFastestCache.php";s:11:"new_version";s:7:"0.8.9.0";s:3:"url";s:47:"https://wordpress.org/plugins/wp-fastest-cache/";s:7:"package";s:67:"https://downloads.wordpress.org/plugin/wp-fastest-cache.0.8.9.0.zip";s:5:"icons";a:1:{s:2:"1x";s:69:"https://ps.w.org/wp-fastest-cache/assets/icon-128x128.png?rev=1068904";}s:7:"banners";a:1:{s:2:"1x";s:71:"https://ps.w.org/wp-fastest-cache/assets/banner-772x250.jpg?rev=1064099";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";b:0;s:13:"compatibility";O:8:"stdClass":0:{}}s:27:"wp-meta-seo/wp-meta-seo.php";O:8:"stdClass":12:{s:2:"id";s:25:"w.org/plugins/wp-meta-seo";s:4:"slug";s:11:"wp-meta-seo";s:6:"plugin";s:27:"wp-meta-seo/wp-meta-seo.php";s:11:"new_version";s:5:"4.0.3";s:3:"url";s:42:"https://wordpress.org/plugins/wp-meta-seo/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/wp-meta-seo.4.0.3.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/wp-meta-seo/assets/icon-256x256.png?rev=1900542";s:2:"1x";s:64:"https://ps.w.org/wp-meta-seo/assets/icon-128x128.png?rev=1900544";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/wp-meta-seo/assets/banner-1544x500.png?rev=1900539";s:2:"1x";s:66:"https://ps.w.org/wp-meta-seo/assets/banner-772x250.png?rev=1900541";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";s:3:"5.3";s:13:"compatibility";O:8:"stdClass":0:{}}s:24:"wordpress-seo/wp-seo.php";O:8:"stdClass":12:{s:2:"id";s:27:"w.org/plugins/wordpress-seo";s:4:"slug";s:13:"wordpress-seo";s:6:"plugin";s:24:"wordpress-seo/wp-seo.php";s:11:"new_version";s:3:"9.5";s:3:"url";s:44:"https://wordpress.org/plugins/wordpress-seo/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/wordpress-seo.9.5.zip";s:5:"icons";a:3:{s:2:"2x";s:66:"https://ps.w.org/wordpress-seo/assets/icon-256x256.png?rev=1834347";s:2:"1x";s:58:"https://ps.w.org/wordpress-seo/assets/icon.svg?rev=1946641";s:3:"svg";s:58:"https://ps.w.org/wordpress-seo/assets/icon.svg?rev=1946641";}s:7:"banners";a:2:{s:2:"2x";s:69:"https://ps.w.org/wordpress-seo/assets/banner-1544x500.png?rev=1843435";s:2:"1x";s:68:"https://ps.w.org/wordpress-seo/assets/banner-772x250.png?rev=1843435";}s:11:"banners_rtl";a:2:{s:2:"2x";s:73:"https://ps.w.org/wordpress-seo/assets/banner-1544x500-rtl.png?rev=1843435";s:2:"1x";s:72:"https://ps.w.org/wordpress-seo/assets/banner-772x250-rtl.png?rev=1843435";}s:6:"tested";s:5:"5.0.3";s:12:"requires_php";s:5:"5.2.4";s:13:"compatibility";O:8:"stdClass":0:{}}}s:12:"translations";a:0:{}s:9:"no_update";a:26:{s:19:"akismet/akismet.php";O:8:"stdClass":9:{s:2:"id";s:21:"w.org/plugins/akismet";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:3:"4.1";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:54:"https://downloads.wordpress.org/plugin/akismet.4.1.zip";s:5:"icons";a:2:{s:2:"2x";s:59:"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272";s:2:"1x";s:59:"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272";}s:7:"banners";a:1:{s:2:"1x";s:61:"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904";}s:11:"banners_rtl";a:0:{}}s:51:"all-in-one-wp-migration/all-in-one-wp-migration.php";O:8:"stdClass":9:{s:2:"id";s:37:"w.org/plugins/all-in-one-wp-migration";s:4:"slug";s:23:"all-in-one-wp-migration";s:6:"plugin";s:51:"all-in-one-wp-migration/all-in-one-wp-migration.php";s:11:"new_version";s:4:"6.83";s:3:"url";s:54:"https://wordpress.org/plugins/all-in-one-wp-migration/";s:7:"package";s:71:"https://downloads.wordpress.org/plugin/all-in-one-wp-migration.6.83.zip";s:5:"icons";a:2:{s:2:"2x";s:76:"https://ps.w.org/all-in-one-wp-migration/assets/icon-256x256.png?rev=1985064";s:2:"1x";s:76:"https://ps.w.org/all-in-one-wp-migration/assets/icon-128x128.png?rev=1985064";}s:7:"banners";a:2:{s:2:"2x";s:79:"https://ps.w.org/all-in-one-wp-migration/assets/banner-1544x500.png?rev=1985064";s:2:"1x";s:78:"https://ps.w.org/all-in-one-wp-migration/assets/banner-772x250.png?rev=1985064";}s:11:"banners_rtl";a:0:{}}s:27:"autoptimize/autoptimize.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/autoptimize";s:4:"slug";s:11:"autoptimize";s:6:"plugin";s:27:"autoptimize/autoptimize.php";s:11:"new_version";s:5:"2.4.4";s:3:"url";s:42:"https://wordpress.org/plugins/autoptimize/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/autoptimize.2.4.4.zip";s:5:"icons";a:1:{s:2:"1x";s:64:"https://ps.w.org/autoptimize/assets/icon-128x128.png?rev=1864142";}s:7:"banners";a:1:{s:2:"1x";s:66:"https://ps.w.org/autoptimize/assets/banner-772x250.jpg?rev=1315920";}s:11:"banners_rtl";a:0:{}}s:19:"fenshop/FenShop.php";O:8:"stdClass":9:{s:2:"id";s:21:"w.org/plugins/fenshop";s:4:"slug";s:7:"fenshop";s:6:"plugin";s:19:"fenshop/FenShop.php";s:11:"new_version";s:6:"1.13.2";s:3:"url";s:38:"https://wordpress.org/plugins/fenshop/";s:7:"package";s:50:"https://downloads.wordpress.org/plugin/fenshop.zip";s:5:"icons";a:2:{s:2:"2x";s:60:"https://ps.w.org/fenshop/assets/icon-256x256.png?rev=1532708";s:2:"1x";s:60:"https://ps.w.org/fenshop/assets/icon-256x256.png?rev=1532708";}s:7:"banners";a:1:{s:2:"1x";s:62:"https://ps.w.org/fenshop/assets/banner-772x250.png?rev=1532708";}s:11:"banners_rtl";a:0:{}}s:21:"fotomoto/fotomoto.php";O:8:"stdClass":9:{s:2:"id";s:22:"w.org/plugins/fotomoto";s:4:"slug";s:8:"fotomoto";s:6:"plugin";s:21:"fotomoto/fotomoto.php";s:11:"new_version";s:5:"1.2.1";s:3:"url";s:39:"https://wordpress.org/plugins/fotomoto/";s:7:"package";s:51:"https://downloads.wordpress.org/plugin/fotomoto.zip";s:5:"icons";a:2:{s:2:"2x";s:61:"https://ps.w.org/fotomoto/assets/icon-256x256.png?rev=1910170";s:2:"1x";s:61:"https://ps.w.org/fotomoto/assets/icon-128x128.png?rev=1910170";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}}s:9:"hello.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/hello-dolly";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";s:5:"icons";a:2:{s:2:"2x";s:63:"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907";s:2:"1x";s:63:"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907";}s:7:"banners";a:1:{s:2:"1x";s:65:"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342";}s:11:"banners_rtl";a:0:{}}s:21:"hello-dolly/hello.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/hello-dolly";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:21:"hello-dolly/hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";s:5:"icons";a:2:{s:2:"2x";s:63:"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=969907";s:2:"1x";s:63:"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=969907";}s:7:"banners";a:1:{s:2:"1x";s:65:"https://ps.w.org/hello-dolly/assets/banner-772x250.png?rev=478342";}s:11:"banners_rtl";a:0:{}}s:23:"instashop/instashop.php";O:8:"stdClass":9:{s:2:"id";s:23:"w.org/plugins/instashop";s:4:"slug";s:9:"instashop";s:6:"plugin";s:23:"instashop/instashop.php";s:11:"new_version";s:5:"1.2.0";s:3:"url";s:40:"https://wordpress.org/plugins/instashop/";s:7:"package";s:52:"https://downloads.wordpress.org/plugin/instashop.zip";s:5:"icons";a:2:{s:2:"2x";s:62:"https://ps.w.org/instashop/assets/icon-256x256.jpg?rev=1752557";s:2:"1x";s:62:"https://ps.w.org/instashop/assets/icon-128x128.jpg?rev=1752557";}s:7:"banners";a:2:{s:2:"2x";s:65:"https://ps.w.org/instashop/assets/banner-1544x500.jpg?rev=1754002";s:2:"1x";s:64:"https://ps.w.org/instashop/assets/banner-772x250.jpg?rev=1754002";}s:11:"banners_rtl";a:0:{}}s:19:"jetpack/jetpack.php";O:8:"stdClass":9:{s:2:"id";s:21:"w.org/plugins/jetpack";s:4:"slug";s:7:"jetpack";s:6:"plugin";s:19:"jetpack/jetpack.php";s:11:"new_version";s:3:"6.9";s:3:"url";s:38:"https://wordpress.org/plugins/jetpack/";s:7:"package";s:54:"https://downloads.wordpress.org/plugin/jetpack.6.9.zip";s:5:"icons";a:3:{s:2:"2x";s:60:"https://ps.w.org/jetpack/assets/icon-256x256.png?rev=1791404";s:2:"1x";s:52:"https://ps.w.org/jetpack/assets/icon.svg?rev=1791404";s:3:"svg";s:52:"https://ps.w.org/jetpack/assets/icon.svg?rev=1791404";}s:7:"banners";a:2:{s:2:"2x";s:63:"https://ps.w.org/jetpack/assets/banner-1544x500.png?rev=1791404";s:2:"1x";s:62:"https://ps.w.org/jetpack/assets/banner-772x250.png?rev=1791404";}s:11:"banners_rtl";a:0:{}}s:23:"ml-slider/ml-slider.php";O:8:"stdClass":9:{s:2:"id";s:23:"w.org/plugins/ml-slider";s:4:"slug";s:9:"ml-slider";s:6:"plugin";s:23:"ml-slider/ml-slider.php";s:11:"new_version";s:6:"3.10.3";s:3:"url";s:40:"https://wordpress.org/plugins/ml-slider/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/ml-slider.3.10.3.zip";s:5:"icons";a:3:{s:2:"2x";s:62:"https://ps.w.org/ml-slider/assets/icon-256x256.png?rev=1837669";s:2:"1x";s:54:"https://ps.w.org/ml-slider/assets/icon.svg?rev=1837669";s:3:"svg";s:54:"https://ps.w.org/ml-slider/assets/icon.svg?rev=1837669";}s:7:"banners";a:2:{s:2:"2x";s:65:"https://ps.w.org/ml-slider/assets/banner-1544x500.png?rev=1837669";s:2:"1x";s:64:"https://ps.w.org/ml-slider/assets/banner-772x250.png?rev=1837669";}s:11:"banners_rtl";a:0:{}}s:27:"ninja-forms/ninja-forms.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/ninja-forms";s:4:"slug";s:11:"ninja-forms";s:6:"plugin";s:27:"ninja-forms/ninja-forms.php";s:11:"new_version";s:5:"3.4.2";s:3:"url";s:42:"https://wordpress.org/plugins/ninja-forms/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/ninja-forms.3.4.2.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/ninja-forms/assets/icon-256x256.png?rev=1649747";s:2:"1x";s:64:"https://ps.w.org/ninja-forms/assets/icon-128x128.png?rev=1649747";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/ninja-forms/assets/banner-1544x500.png?rev=1649747";s:2:"1x";s:66:"https://ps.w.org/ninja-forms/assets/banner-772x250.png?rev=1649747";}s:11:"banners_rtl";a:0:{}}s:23:"payfacile/payfacile.php";O:8:"stdClass":9:{s:2:"id";s:23:"w.org/plugins/payfacile";s:4:"slug";s:9:"payfacile";s:6:"plugin";s:23:"payfacile/payfacile.php";s:11:"new_version";s:5:"1.0.1";s:3:"url";s:40:"https://wordpress.org/plugins/payfacile/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/payfacile.1.0.1.zip";s:5:"icons";a:1:{s:7:"default";s:53:"https://s.w.org/plugins/geopattern-icon/payfacile.svg";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}}s:45:"paygreen-woocommerce/paygreen-woocommerce.php";O:8:"stdClass":9:{s:2:"id";s:34:"w.org/plugins/paygreen-woocommerce";s:4:"slug";s:20:"paygreen-woocommerce";s:6:"plugin";s:45:"paygreen-woocommerce/paygreen-woocommerce.php";s:11:"new_version";s:5:"2.1.6";s:3:"url";s:51:"https://wordpress.org/plugins/paygreen-woocommerce/";s:7:"package";s:63:"https://downloads.wordpress.org/plugin/paygreen-woocommerce.zip";s:5:"icons";a:2:{s:2:"2x";s:73:"https://ps.w.org/paygreen-woocommerce/assets/icon-256x256.jpg?rev=1908063";s:2:"1x";s:73:"https://ps.w.org/paygreen-woocommerce/assets/icon-256x256.jpg?rev=1908063";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}}s:19:"refiral/refiral.php";O:8:"stdClass":9:{s:2:"id";s:21:"w.org/plugins/refiral";s:4:"slug";s:7:"refiral";s:6:"plugin";s:19:"refiral/refiral.php";s:11:"new_version";s:3:"1.0";s:3:"url";s:38:"https://wordpress.org/plugins/refiral/";s:7:"package";s:50:"https://downloads.wordpress.org/plugin/refiral.zip";s:5:"icons";a:1:{s:7:"default";s:51:"https://s.w.org/plugins/geopattern-icon/refiral.svg";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}}s:27:"seo-booster/seo-booster.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/seo-booster";s:4:"slug";s:11:"seo-booster";s:6:"plugin";s:27:"seo-booster/seo-booster.php";s:11:"new_version";s:5:"3.4.7";s:3:"url";s:42:"https://wordpress.org/plugins/seo-booster/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/seo-booster.3.4.7.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/seo-booster/assets/icon-256x256.jpg?rev=1816989";s:2:"1x";s:64:"https://ps.w.org/seo-booster/assets/icon-128x128.jpg?rev=1816989";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/seo-booster/assets/banner-1544x500.jpg?rev=1867721";s:2:"1x";s:66:"https://ps.w.org/seo-booster/assets/banner-772x250.jpg?rev=1867721";}s:11:"banners_rtl";a:0:{}}s:24:"wp-seopress/seopress.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/wp-seopress";s:4:"slug";s:11:"wp-seopress";s:6:"plugin";s:24:"wp-seopress/seopress.php";s:11:"new_version";s:5:"3.3.6";s:3:"url";s:42:"https://wordpress.org/plugins/wp-seopress/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/wp-seopress.3.3.6.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/wp-seopress/assets/icon-256x256.png?rev=1993062";s:2:"1x";s:64:"https://ps.w.org/wp-seopress/assets/icon-128x128.png?rev=1993062";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/wp-seopress/assets/banner-1544x500.png?rev=1824139";s:2:"1x";s:66:"https://ps.w.org/wp-seopress/assets/banner-772x250.png?rev=1824139";}s:11:"banners_rtl";a:0:{}}s:23:"wp-smushit/wp-smush.php";O:8:"stdClass":9:{s:2:"id";s:24:"w.org/plugins/wp-smushit";s:4:"slug";s:10:"wp-smushit";s:6:"plugin";s:23:"wp-smushit/wp-smush.php";s:11:"new_version";s:5:"3.0.2";s:3:"url";s:41:"https://wordpress.org/plugins/wp-smushit/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/wp-smushit.3.0.2.zip";s:5:"icons";a:2:{s:2:"2x";s:63:"https://ps.w.org/wp-smushit/assets/icon-256x256.jpg?rev=1513049";s:2:"1x";s:63:"https://ps.w.org/wp-smushit/assets/icon-128x128.jpg?rev=1513049";}s:7:"banners";a:2:{s:2:"2x";s:66:"https://ps.w.org/wp-smushit/assets/banner-1544x500.png?rev=1863697";s:2:"1x";s:65:"https://ps.w.org/wp-smushit/assets/banner-772x250.png?rev=1863697";}s:11:"banners_rtl";a:0:{}}s:21:"squareoffs/plugin.php";O:8:"stdClass":9:{s:2:"id";s:24:"w.org/plugins/squareoffs";s:4:"slug";s:10:"squareoffs";s:6:"plugin";s:21:"squareoffs/plugin.php";s:11:"new_version";s:5:"1.1.0";s:3:"url";s:41:"https://wordpress.org/plugins/squareoffs/";s:7:"package";s:53:"https://downloads.wordpress.org/plugin/squareoffs.zip";s:5:"icons";a:2:{s:2:"2x";s:63:"https://ps.w.org/squareoffs/assets/icon-256x256.png?rev=1759645";s:2:"1x";s:63:"https://ps.w.org/squareoffs/assets/icon-128x128.png?rev=1759645";}s:7:"banners";a:2:{s:2:"2x";s:66:"https://ps.w.org/squareoffs/assets/banner-1544x500.png?rev=1759645";s:2:"1x";s:65:"https://ps.w.org/squareoffs/assets/banner-772x250.png?rev=1759645";}s:11:"banners_rtl";a:0:{}}s:43:"woocommerce-payplug/woocommerce-payplug.php";O:8:"stdClass":9:{s:2:"id";s:33:"w.org/plugins/woocommerce-payplug";s:4:"slug";s:19:"woocommerce-payplug";s:6:"plugin";s:43:"woocommerce-payplug/woocommerce-payplug.php";s:11:"new_version";s:5:"3.1.0";s:3:"url";s:50:"https://wordpress.org/plugins/woocommerce-payplug/";s:7:"package";s:62:"https://downloads.wordpress.org/plugin/woocommerce-payplug.zip";s:5:"icons";a:2:{s:2:"2x";s:71:"https://ps.w.org/woocommerce-payplug/assets/icon-256x256.jpg?rev=993455";s:2:"1x";s:71:"https://ps.w.org/woocommerce-payplug/assets/icon-128x128.jpg?rev=993455";}s:7:"banners";a:1:{s:2:"1x";s:74:"https://ps.w.org/woocommerce-payplug/assets/banner-772x250.png?rev=1402254";}s:11:"banners_rtl";a:0:{}}s:23:"wordfence/wordfence.php";O:8:"stdClass":9:{s:2:"id";s:23:"w.org/plugins/wordfence";s:4:"slug";s:9:"wordfence";s:6:"plugin";s:23:"wordfence/wordfence.php";s:11:"new_version";s:6:"7.1.20";s:3:"url";s:40:"https://wordpress.org/plugins/wordfence/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/wordfence.7.1.20.zip";s:5:"icons";a:2:{s:2:"2x";s:62:"https://ps.w.org/wordfence/assets/icon-256x256.png?rev=1457724";s:2:"1x";s:62:"https://ps.w.org/wordfence/assets/icon-128x128.png?rev=1457724";}s:7:"banners";a:2:{s:2:"2x";s:65:"https://ps.w.org/wordfence/assets/banner-1544x500.png?rev=1808795";s:2:"1x";s:64:"https://ps.w.org/wordfence/assets/banner-772x250.png?rev=1808795";}s:11:"banners_rtl";a:0:{}}s:41:"wordpress-importer/wordpress-importer.php";O:8:"stdClass":9:{s:2:"id";s:32:"w.org/plugins/wordpress-importer";s:4:"slug";s:18:"wordpress-importer";s:6:"plugin";s:41:"wordpress-importer/wordpress-importer.php";s:11:"new_version";s:5:"0.6.4";s:3:"url";s:49:"https://wordpress.org/plugins/wordpress-importer/";s:7:"package";s:67:"https://downloads.wordpress.org/plugin/wordpress-importer.0.6.4.zip";s:5:"icons";a:3:{s:2:"2x";s:71:"https://ps.w.org/wordpress-importer/assets/icon-256x256.png?rev=1908375";s:2:"1x";s:63:"https://ps.w.org/wordpress-importer/assets/icon.svg?rev=1908375";s:3:"svg";s:63:"https://ps.w.org/wordpress-importer/assets/icon.svg?rev=1908375";}s:7:"banners";a:1:{s:2:"1x";s:72:"https://ps.w.org/wordpress-importer/assets/banner-772x250.png?rev=547654";}s:11:"banners_rtl";a:0:{}}s:17:"wpshop/wpshop.php";O:8:"stdClass":9:{s:2:"id";s:20:"w.org/plugins/wpshop";s:4:"slug";s:6:"wpshop";s:6:"plugin";s:17:"wpshop/wpshop.php";s:11:"new_version";s:5:"1.6.1";s:3:"url";s:37:"https://wordpress.org/plugins/wpshop/";s:7:"package";s:55:"https://downloads.wordpress.org/plugin/wpshop.1.6.1.zip";s:5:"icons";a:2:{s:2:"2x";s:59:"https://ps.w.org/wpshop/assets/icon-256x256.png?rev=1104844";s:2:"1x";s:59:"https://ps.w.org/wpshop/assets/icon-128x128.png?rev=1104844";}s:7:"banners";a:2:{s:2:"2x";s:62:"https://ps.w.org/wpshop/assets/banner-1544x500.jpg?rev=1743753";s:2:"1x";s:61:"https://ps.w.org/wpshop/assets/banner-772x250.jpg?rev=1743753";}s:11:"banners_rtl";a:0:{}}s:51:"wp-e-commerce-cheques-virement-bancaires/loader.php";O:8:"stdClass":9:{s:2:"id";s:54:"w.org/plugins/wp-e-commerce-cheques-virement-bancaires";s:4:"slug";s:40:"wp-e-commerce-cheques-virement-bancaires";s:6:"plugin";s:51:"wp-e-commerce-cheques-virement-bancaires/loader.php";s:11:"new_version";s:5:"1.0.4";s:3:"url";s:71:"https://wordpress.org/plugins/wp-e-commerce-cheques-virement-bancaires/";s:7:"package";s:89:"https://downloads.wordpress.org/plugin/wp-e-commerce-cheques-virement-bancaires.1.0.4.zip";s:5:"icons";a:1:{s:7:"default";s:84:"https://s.w.org/plugins/geopattern-icon/wp-e-commerce-cheques-virement-bancaires.svg";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}}s:27:"wp-super-cache/wp-cache.php";O:8:"stdClass":9:{s:2:"id";s:28:"w.org/plugins/wp-super-cache";s:4:"slug";s:14:"wp-super-cache";s:6:"plugin";s:27:"wp-super-cache/wp-cache.php";s:11:"new_version";s:5:"1.6.4";s:3:"url";s:45:"https://wordpress.org/plugins/wp-super-cache/";s:7:"package";s:63:"https://downloads.wordpress.org/plugin/wp-super-cache.1.6.4.zip";s:5:"icons";a:2:{s:2:"2x";s:67:"https://ps.w.org/wp-super-cache/assets/icon-256x256.png?rev=1095422";s:2:"1x";s:67:"https://ps.w.org/wp-super-cache/assets/icon-128x128.png?rev=1095422";}s:7:"banners";a:2:{s:2:"2x";s:70:"https://ps.w.org/wp-super-cache/assets/banner-1544x500.png?rev=1082414";s:2:"1x";s:69:"https://ps.w.org/wp-super-cache/assets/banner-772x250.png?rev=1082414";}s:11:"banners_rtl";a:0:{}}s:31:"xili-language/xili-language.php";O:8:"stdClass":9:{s:2:"id";s:27:"w.org/plugins/xili-language";s:4:"slug";s:13:"xili-language";s:6:"plugin";s:31:"xili-language/xili-language.php";s:11:"new_version";s:6:"2.21.2";s:3:"url";s:44:"https://wordpress.org/plugins/xili-language/";s:7:"package";s:63:"https://downloads.wordpress.org/plugin/xili-language.2.21.2.zip";s:5:"icons";a:2:{s:2:"2x";s:65:"https://ps.w.org/xili-language/assets/icon-256x256.png?rev=970404";s:2:"1x";s:65:"https://ps.w.org/xili-language/assets/icon-128x128.png?rev=970404";}s:7:"banners";a:1:{s:2:"1x";s:67:"https://ps.w.org/xili-language/assets/banner-772x250.jpg?rev=712518";}s:11:"banners_rtl";a:0:{}}s:61:"yoast-seo-search-index-purge/yoast-seo-search-index-purge.php";O:8:"stdClass":9:{s:2:"id";s:42:"w.org/plugins/yoast-seo-search-index-purge";s:4:"slug";s:28:"yoast-seo-search-index-purge";s:6:"plugin";s:61:"yoast-seo-search-index-purge/yoast-seo-search-index-purge.php";s:11:"new_version";s:5:"1.1.0";s:3:"url";s:59:"https://wordpress.org/plugins/yoast-seo-search-index-purge/";s:7:"package";s:77:"https://downloads.wordpress.org/plugin/yoast-seo-search-index-purge.1.1.0.zip";s:5:"icons";a:3:{s:2:"2x";s:81:"https://ps.w.org/yoast-seo-search-index-purge/assets/icon-256x256.png?rev=1883805";s:2:"1x";s:73:"https://ps.w.org/yoast-seo-search-index-purge/assets/icon.svg?rev=1968176";s:3:"svg";s:73:"https://ps.w.org/yoast-seo-search-index-purge/assets/icon.svg?rev=1968176";}s:7:"banners";a:2:{s:2:"2x";s:84:"https://ps.w.org/yoast-seo-search-index-purge/assets/banner-1544x500.png?rev=1968176";s:2:"1x";s:83:"https://ps.w.org/yoast-seo-search-index-purge/assets/banner-772x250.png?rev=1968176";}s:11:"banners_rtl";a:2:{s:2:"2x";s:88:"https://ps.w.org/yoast-seo-search-index-purge/assets/banner-1544x500-rtl.png?rev=1968176";s:2:"1x";s:87:"https://ps.w.org/yoast-seo-search-index-purge/assets/banner-772x250-rtl.png?rev=1968176";}}}}', 'no');

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 5, '_edit_lock', '1547824715:1'),
(4, 5, '_wp_trash_meta_status', 'publish'),
(5, 5, '_wp_trash_meta_time', '1547824732');

CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2019-01-18 16:16:22', '2019-01-18 15:16:22', '<!-- wp:paragraph -->\n<p>Bienvenue sur WordPress. Ceci est votre premier article. Modifiez où supprimez-le, puis commencez à écrire !</p>\n<!-- /wp:paragraph -->', 'Bonjour tout le monde !', '', 'publish', 'open', 'open', '', 'bonjour-tout-le-monde', '', '', '2019-01-18 16:16:22', '2019-01-18 15:16:22', '', 0, 'https://wordpress.camency.fr/?p=1', 0, 'post', '', 1),
(2, 1, '2019-01-18 16:16:22', '2019-01-18 15:16:22', '<!-- wp:paragraph -->\n<p>Ceci est une page d’exemple. C’est différent d’un article de blog parce qu’elle restera au même endroit et apparaîtra dans la navigation de votre site (dans la plupart des thèmes). La plupart des gens commencent par une page « À propos » qui les présente aux visiteurs du site. Cela pourrait ressembler à quelque chose comme cela :</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class="wp-block-quote"><p>Bonjour ! Je suis un mécanicien qui aspire à devenir acteur, et voici mon site. J’habite à Bordeaux, j’ai un super chien baptisé Russell, et j’aime la vodka-ananas (ainsi qu’être surpris par la pluie soudaine lors de longues balades sur la plage au coucher du soleil).</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>... ou quelque chose comme cela :</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class="wp-block-quote"><p>La société 123 Machin Truc a été créée en 1971, et n’a cessé de proposer au public des machins-trucs de qualité depuis lors. Située à Saint-Remy-en-Bouzemont-Saint-Genest-et-Isson, 123 Machin Truc emploie 2 000 personnes, et fabrique toutes sortes de bidules super pour la communauté bouzemontoise.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>En tant que nouvel·le utilisateur ou utilisatrice de WordPress, vous devriez vous rendre sur <a href="https://wordpress.camency.fr/wp-admin/">votre tableau de bord</a> pour supprimer cette page et créer de nouvelles pages pour votre contenu. Amusez-vous bien !</p>\n<!-- /wp:paragraph -->', 'Page d’exemple', '', 'publish', 'closed', 'open', '', 'page-d-exemple', '', '', '2019-01-18 16:16:22', '2019-01-18 15:16:22', '', 0, 'https://wordpress.camency.fr/?page_id=2', 0, 'page', '', 0),
(3, 1, '2019-01-18 16:16:22', '2019-01-18 15:16:22', '<!-- wp:heading --><h2>Qui sommes-nous ?</h2><!-- /wp:heading --><!-- wp:paragraph --><p>L’adresse de notre site Web est : https://wordpress.camency.fr.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Utilisation des données personnelles collectées</h2><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Commentaires</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Quand vous laissez un commentaire sur notre site web, les données inscrites dans le formulaire de commentaire, mais aussi votre adresse IP et l’agent utilisateur de votre navigateur sont collectés pour nous aider à la détection des commentaires indésirables.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Une chaîne anonymisée créée à partir de votre adresse de messagerie (également appelée hash) peut être envoyée au service Gravatar pour vérifier si vous utilisez ce dernier. Les clauses de confidentialité du service Gravatar sont disponibles ici : https://automattic.com/privacy/. Après validation de votre commentaire, votre photo de profil sera visible publiquement à coté de votre commentaire.</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Médias</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Si vous êtes un utilisateur ou une utilisatrice enregistré·e et que vous téléversez des images sur le site web, nous vous conseillons d’éviter de téléverser des images contenant des données EXIF de coordonnées GPS. Les visiteurs de votre site web peuvent télécharger et extraire des données de localisation depuis ces images.</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Formulaires de contact</h3><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Cookies</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Si vous déposez un commentaire sur notre site, il vous sera proposé d’enregistrer votre nom, adresse de messagerie et site web dans des cookies. C’est uniquement pour votre confort afin de ne pas avoir à saisir ces informations si vous déposez un autre commentaire plus tard. Ces cookies expirent au bout d’un an.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Si vous avez un compte et que vous vous connectez sur ce site, un cookie temporaire sera créé afin de déterminer si votre navigateur accepte les cookies. Il ne contient pas de données personnelles et sera supprimé automatiquement à la fermeture de votre navigateur.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Lorsque vous vous connecterez, nous mettrons en place un certain nombre de cookies pour enregistrer vos informations de connexion et vos préférences d’écran. La durée de vie d’un cookie de connexion est de deux jours, celle d’un cookie d’option d’écran est d’un an. Si vous cochez « Se souvenir de moi », votre cookie de connexion sera conservé pendant deux semaines. Si vous vous déconnectez de votre compte, le cookie de connexion sera effacé.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>En modifiant ou en publiant une publication, un cookie supplémentaire sera enregistré dans votre navigateur. Ce cookie ne comprend aucune donnée personnelle. Il indique simplement l’ID de la publication que vous venez de modifier. Il expire au bout d’un jour.</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Contenu embarqué depuis d’autres sites</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Les articles de ce site peuvent inclure des contenus intégrés (par exemple des vidéos, images, articles…). Le contenu intégré depuis d’autres sites se comporte de la même manière que si le visiteur se rendait sur cet autre site.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Ces sites web pourraient collecter des données sur vous, utiliser des cookies, embarquer des outils de suivis tiers, suivre vos interactions avec ces contenus embarqués si vous disposez d’un compte connecté sur leur site web.</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Statistiques et mesures d’audience</h3><!-- /wp:heading --><!-- wp:heading --><h2>Utilisation et transmission de vos données personnelles</h2><!-- /wp:heading --><!-- wp:heading --><h2>Durées de stockage de vos données</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Si vous laissez un commentaire, le commentaire et ses métadonnées sont conservés indéfiniment. Cela permet de reconnaître et approuver automatiquement les commentaires suivants au lieu de les laisser dans la file de modération.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Pour les utilisateurs et utilisatrices qui s’enregistrent sur notre site (si cela est possible), nous stockons également les données personnelles indiquées dans leur profil. Tous les utilisateurs et utilisatrices peuvent voir, modifier ou supprimer leurs informations personnelles à tout moment (à l’exception de leur nom d’utilisateur·ice). Les gestionnaires du site peuvent aussi voir et modifier ces informations.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Les droits que vous avez sur vos données</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Si vous avez un compte ou si vous avez laissé des commentaires sur le site, vous pouvez demander à recevoir un fichier contenant toutes les données personnelles que nous possédons à votre sujet, incluant celles que vous nous avez fournies. Vous pouvez également demander la suppression des données personnelles vous concernant. Cela ne prend pas en compte les données stockées à des fins administratives, légales ou pour des raisons de sécurité.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Transmission de vos données personnelles</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Les commentaires des visiteurs peuvent être vérifiés à l’aide d’un service automatisé de détection des commentaires indésirables.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Informations de contact</h2><!-- /wp:heading --><!-- wp:heading --><h2>Informations supplémentaires</h2><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Comment nous protégeons vos données</h3><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Procédures mises en œuvre en cas de fuite de données</h3><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Les services tiers qui nous transmettent des données</h3><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Opérations de marketing automatisé et/ou de profilage réalisées à l’aide des données personnelles</h3><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3>Affichage des informations liées aux secteurs soumis à des régulations spécifiques</h3><!-- /wp:heading -->', 'Politique de confidentialité', '', 'draft', 'closed', 'open', '', 'politique-de-confidentialite', '', '', '2019-01-18 16:16:22', '2019-01-18 15:16:22', '', 0, 'https://wordpress.camency.fr/?page_id=3', 0, 'page', '', 0),
(4, 1, '2019-01-18 16:16:42', '0000-00-00 00:00:00', '', 'Brouillon auto', '', 'auto-draft', 'open', 'open', '', '', '', '', '2019-01-18 16:16:42', '0000-00-00 00:00:00', '', 0, 'https://wordpress.camency.fr/?p=4', 0, 'post', '', 0),
(5, 1, '2019-01-18 16:18:52', '2019-01-18 15:18:52', '{\n    "old_sidebars_widgets_data": {\n        "value": {\n            "wp_inactive_widgets": [],\n            "sidebar-1": [\n                "search-2",\n                "recent-posts-2",\n                "recent-comments-2",\n                "archives-2",\n                "categories-2",\n                "meta-2"\n            ]\n        },\n        "type": "global_variable",\n        "user_id": 1,\n        "date_modified_gmt": "2019-01-18 15:18:34"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', 'e52eccff-4d48-448e-94e4-b554f8125fcc', '', '', '2019-01-18 16:18:52', '2019-01-18 15:18:52', '', 0, 'https://wordpress.camency.fr/?p=5', 0, 'customize_changeset', '', 0);

CREATE TABLE `wp_rank_math_404_logs` (
  `id` bigint(20) unsigned NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `times_accessed` bigint(20) unsigned NOT NULL DEFAULT '1',
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `referer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_rank_math_internal_links` (
  `id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `target_post_id` bigint(20) unsigned NOT NULL,
  `type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_rank_math_internal_meta` (
  `object_id` bigint(20) unsigned NOT NULL,
  `internal_link_count` int(10) unsigned DEFAULT '0',
  `external_link_count` int(10) unsigned DEFAULT '0',
  `incoming_link_count` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_rank_math_redirections` (
  `id` bigint(20) unsigned NOT NULL,
  `sources` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_to` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_code` smallint(4) unsigned NOT NULL,
  `hits` bigint(20) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_accessed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_rank_math_redirections_cache` (
  `id` bigint(20) unsigned NOT NULL,
  `from_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirection_id` bigint(20) unsigned NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `object_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `is_redirected` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_rank_math_sc_analytics` (
  `id` bigint(20) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `property` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clicks` mediumint(6) NOT NULL,
  `impressions` mediumint(6) NOT NULL,
  `position` double NOT NULL,
  `ctr` double NOT NULL,
  `dimension` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Non classé', 'non-classe', 0);

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1);

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'wordpress'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy,plugin_editor_notice'),
(15, 1, 'show_welcome_panel', '1'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '4'),
(18, 1, 'community-events-location', 'a:1:{s:2:"ip";s:9:"127.0.0.0";}'),
(20, 1, 'session_tokens', 'a:1:{s:64:"3ddfe3f6cd0e4d5734603e9337168c976cf599499e4f8cbf54dcc71e17c8d6e7";a:4:{s:10:"expiration";i:1549045435;s:2:"ip";s:9:"127.0.0.1";s:2:"ua";s:81:"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:48.0) Gecko/20100101 Firefox/48.0";s:5:"login";i:1547835835;}}');

CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'wordpress', '$P$BAGQSaI1glGvSCjruAjTP5XG8YvhXn.', 'wordpress', 'admin@wordpress.fr', '', '2019-01-18 15:16:22', '', 0, 'wordpress');

CREATE TABLE `wp_yoast_seo_links` (
  `id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `target_post_id` bigint(20) unsigned NOT NULL,
  `type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wp_yoast_seo_meta` (
  `object_id` bigint(20) unsigned NOT NULL,
  `internal_link_count` int(10) unsigned DEFAULT NULL,
  `incoming_link_count` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

ALTER TABLE `wp_rank_math_404_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uri` (`uri`(191));

ALTER TABLE `wp_rank_math_internal_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_direction` (`post_id`,`type`);

ALTER TABLE `wp_rank_math_internal_meta`
  ADD UNIQUE KEY `object_id` (`object_id`);

ALTER TABLE `wp_rank_math_redirections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

ALTER TABLE `wp_rank_math_redirections_cache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `redirection_id` (`redirection_id`);

ALTER TABLE `wp_rank_math_sc_analytics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property` (`property`(191));

ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

ALTER TABLE `wp_yoast_seo_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_direction` (`post_id`,`type`);

ALTER TABLE `wp_yoast_seo_meta`
  ADD UNIQUE KEY `object_id` (`object_id`);


ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=308;
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `wp_rank_math_404_logs`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_rank_math_internal_links`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_rank_math_redirections`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_rank_math_redirections_cache`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_rank_math_sc_analytics`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `wp_yoast_seo_links`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
