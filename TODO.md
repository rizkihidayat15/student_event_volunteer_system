# TODO: Modify Admin Upload Documentation for User Portfolio with Dynamic Activities and Registrant Name Search

## Tasks
- [x] Alter user_portfolio table to include type, volunteer_id
- [x] Modify admin/upload_documentation.php to dynamically load events/volunteers based on category
- [x] Add get_activities.php for AJAX loading of activities (special case for 'Kompetisi' to show all events)
- [x] Update search_users.php to search by registrant name (from registration table) with keyword matching
- [x] Update user/portfolio.php to display registered events/volunteers with "Lihat Dokumentasi" button
- [x] Create user/achievement.php to show achievement history details
- [x] Add award column to user_portfolio table
- [x] Add award select field in admin/upload_documentation.php
- [x] Update insert query to save award
- [x] Display award in user/achievement.php
- [x] Make "Lihat Dokumentasi" button green and attractive
- [x] Display achievement page in card format with separate cards for info, certificate, and documentation
- [x] Remove card format from "Kegiatan Terdaftar" section in user/portfolio.php, replace with list style
- [x] Comment out "Kegiatan Terdaftar" and "Sertifikat dan Dokumentasi" sections in user/portfolio.php
- [x] Comment out unused CSS for portfolio list styles
- [x] Modify user/portfolio.php to link "Lihat Dokumentasi" to achievement.php?event_id=...
- [x] Modify user/achievement.php to take event_id parameter, display overview card (Nama Event, Kategori, Penghargaan), and two cards for Dokumentasi and Sertifikat with thumbnails and download buttons
- [ ] Test the complete portfolio and achievement functionality locally

## Progress
- Implementation completed. Ready for testing.
