-- 发布表白
INSERT INTO `saylove_2017_posts`(`nickName`, `tureName`, `toWho`, `contents`, `email`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

-- 点赞记录
INSERT INTO `saylove_2017_like`( `posts_id`, `ip` ) VALUES ([value-1],[value-2])

-- 评论记录
INSERT INTO `saylove_2017_commtents`(`posts_id`, `contents`, `ip`) VALUES ([value-1],[value-2],[value-3])

-- 猜名字 -- 匹配名字
SELECT `id`, `tureName` FROM `saylove_2017_posts` WHERE `id` = 'posts_id' AND `tureName` = 'guessName'

-- 记录猜名字数据
INSERT INTO `saylove_2017_guess`(`posts_id`, `guessName`, `isRight`, `ip`) VALUES ([value-1],[value-2],[value-3],[value-4])

-- 首页输出帖子数据，每次只输出9个数据
SELECT * FROM `saylove_2017_posts` WHERE 1 limit 9

-- 删除某个帖子
DELETE FROM `saylove_2017_posts` WHERE `id` = [posts_id]

-- 编辑某个帖子
UPDATE `saylove_2017_posts` SET `nickName`=[value-2],`tureName`=[value-3],`toWho`=[value-4],`contents`=[value-5],`email`=[value-6],`isDisplay`=[value-7] WHERE `id` = [posts_id]

-- 获取某个帖子的总评论数
SELECT COUNT(posts_id) FROM `saylove_2017_commtents` WHERE `posts_id` = [posts_id]

-- 获取某个帖子的总点赞数
SELECT COUNT(posts_id) FROM `saylove_2017_like` WHERE `posts_id` = [posts_id]

-- 获取某个帖子的评论列表
SELECT * FROM `saylove_2017_commtents` WHERE `posts_id` = [posts_id]

-- 将某个IP加入黑名单
INSERT INTO `saylove_2017_blacklist`(`ip`) VALUES ([value-1])