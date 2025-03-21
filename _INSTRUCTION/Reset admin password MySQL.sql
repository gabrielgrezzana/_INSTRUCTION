-- Reset admin password, change the username to reset the password back to default (default password: 1234)
-- 1234 = $2y$10$uFUG/NJpkwDKhmyX2WKZI.pBiu4/c4HfoaGeL9ZJO864aztDYVbCC
SET @username = 'admin';

UPDATE blog_members SET `password` = '$2y$10$uFUG/NJpkwDKhmyX2WKZI.pBiu4/c4HfoaGeL9ZJO864aztDYVbCC' WHERE username = @username;