set names gbk;
create database alishow;
use alishow;
create table ali_cate(
    cate_id INT PRIMARY KEY auto_increment,
    cate_name VARCHAR(10) UNIQUE not null comment '分类名称',
    cate_slug VARCHAR(10) UNIQUE NOT NULL comment '分类别名',
    cate_class VARCHAR(10) UNIQUE NOT NULL comment '图标',
    cate_status TINYINT NOT NULL default 1 comment '分类状态：1表示启用状态，2禁用状态',
    cate_show TINYINT NOT NULL DEFAULT 1 comment '是否显示分类：1显示，2不显示'
);
INSERT INTO ali_cate VALUES('null','奇趣事','tec','fa-glass','1','1')
,('null','潮科技','funny','fa-phone','1','1'),
('null','会生活','sele','fa-fire','1','1'),
('null','美奇迹','qiji','fa-gift','1','1');

set names gbk;
use alishow;
create table ali_user(
    user_id INT PRIMARY KEY auto_increment,
    user_name VARCHAR(10) UNIQUE not null comment '邮箱名',
    user_slug VARCHAR(10) UNIQUE NOT null comment '别名',
    user_nick VARCHAR(10) UNIQUE NOT NULL comment '昵称',
    user_psw char(32) not null comment '密码md5加密',
    user_pic VARCHAR(100) not null comment '图片地址',
    user_state TINYINT NOT NULL DEFAULT 1 comment '是否激活 1：已激活 0：没激活'
);
INSERT INTO ali_user values
(null,'345@.qq','aad','大飞哥',md5('123456'),11,1),
(null,'343@.qq','aaf','sfds',md5('123456'),11,1),
(null,'342@.qq','aav','vcx',md5('123456'),11,1),
(null,'344@.qq','aaty','sefds',md5('123456'),11,1),
(null,'3456@.qq','aafg','vfe',md5('123456'),11,1),
(null,'565@.qq','aavv','gfds',md5('123456'),11,1),
(null,'36767@.qq','aavvvv','tgb',md5('123456'),11,1),
(null,'36575@.qq','aaggg','mju',md5('123456'),11,1),
(null,'3578@.qq','aagg','ikk',md5('123456'),11,1),
(null,'3986@.qq','aajj','dfgfdgd',md5('123456'),11,1),
(null,'345534@.qq','aajjj','sdfsdf',md5('123456'),11,1),
(null,'7645@.qq','aakk','hgfhs',md5('123456'),11,1),
(null,'8753@.qq','aakkk','ytuyt',md5('123456'),11,1),
(null,'9754@.qq','aalll','qweqw',md5('123456'),11,1),
(null,'345765@.qq','aall','iopoi',md5('123456'),11,1),
(null,'98704@.qq','aaww','czcxc',md5('123456'),11,1),
(null,'34573234@.qq','aaqq','asdqe',md5('123456'),11,1),
(null,'5765874@.qq','aatttr','yoiuy',md5('123456'),11,1),
(null,'456876@.qq','aatrtr','zxccvfy',md5('123456'),11,1),
(null,'3234675@.qq','aaytyt','iuoyth',md5('123456'),11,1);
-- update ali_user set user_slug='萨德' user_nick='123456' where user_name = '123456';
-- update ali_article set article_title='$title',article_slug='$slug',
-- article_content='$content',article_cateid='$category',aritcle_file='$upload',
-- aritcle_updtime='$uptime',aritcle_state='$status' where article_id=$id
-- select * from ali_article where aritcle_cateid='潮科技'

CREATE TABLE ali_article(
    article_id INT PRIMARY KEY auto_increment,
    article_title VARCHAR(30) UNIQUE NOT NULL comment '文章标题',
    article_slug VARCHAR(30) UNIQUE NOT NULL comment '文章别名',
    article_desc VARCHAR(255) NOT NULL comment '文章摘要',
    article_content text NOT NULL comment '文章内容',
    article_author VARCHAR(30) NOT NULL comment '作者',
    article_cateid VARCHAR(30) not null comment '分类',
    aritcle_file VARCHAR(100) not null DEFAULT '' comment '文章封面图片路径',
    aritcle_addtime INT unsigned not null comment '文章发布时间',
    aritcle_updtime INT UNSIGNED not null comment '文章修改时间',
    aritcle_click int unsigned not null comment '点击量',
    aritcle_good int unsigned not null comment '赞数量',
    aritcle_bad INT unsigned not null comment '踩数量',
    aritcle_state ENUM('草稿','已发布') not null DEFAULT '草稿' comment '文章发布状态'
);
CREATE TABLE ali_comments(
    comments_id INT PRIMARY KEY auto_increment,
    comments_user VARCHAR(30) UNIQUE NOT NULL comment '会员用户名',
    comments_psw char(32) NOT NULL comment 'md5加密密码',
    comments_nick VARCHAR(30) UNIQUE NOT NULL comment '会员昵称'
);
INSERT INTO ali_comments values(null,'qwer',md5('123456'),'大飞哥'),
(null,'asdf',md5('123456'),'石头哥'),
(null,'asdgfd',md5('123456'),'剪刀哥'),
(null,'asdasd',md5('123456'),'锄头哥'),
(null,'asafdgd',md5('123456'),'菜刀哥'),
(null,'asdarwfd',md5('123456'),'开山哥'),
(null,'asdasda',md5('123456'),'平头哥');
create TABLE ali_numbers(
    numbers_id INT PRIMARY KEY auto_increment,
    numbers_content VARCHAR(200) comment '评论',
    numbers_memid INT unsigned not null comment '会员id',
    numbers_userid INT unsigned not null comment '用户id',
    numbers_articleid int unsigned not null comment '文章id',
    numbers_time INT unsigned comment '评论时间',
    numbers_state enum('批准','驳回') DEFAULT '驳回' comment '评论状态'
);
INSERT INTO ali_numbers values(null,'牛逼',1,44,8,1519996806,'批准'),
(null,'666',1,44,9,1519996806,'批准'),
(null,'word哥',2,44,10,1519996806,'驳回'),
(null,'牛逼',2,44,11,1519996806,'批准'),
(null,'牛逼',3,44,12,1519996806,'驳回'),
(null,'牛逼',4,44,13,1519996806,'批准'),
(null,'牛逼',5,44,9,1519996806,'驳回'),
(null,'牛逼',6,44,8,1519996806,'批准'),
(null,'牛逼',7,44,14,1519996806,'批准'),
(null,'牛逼',5,44,11,1519996806,'驳回'),
(null,'牛逼',6,44,12,1519996806,'批准');
select numbers_id,comments_nick,numbers_content,article_title,numbers_time,numbers_state,user_id from ali_numbers
        join ali_comments on numbers_memid = comments_id
        join ali_user on numbers_userid = user_id
        join ali_article on numbers_articleid = article_id;


CREATE TABLE ali_slides(
    slides_id INT unsigned PRIMARY KEY auto_increment,
    slides_pic VARCHAR(100) DEFAULT '' comment '图片路径',
    slides_desc VARCHAR(100) NOT NULL comment '文本描述',
    slides_links VARCHAR(100) NOT NULL comment '超链接',
    slides_state enum('显示','隐藏') DEFAULT '隐藏' comment '图片状态'
);

alter table ali_article add article_blur enum('添加焦点','不加焦点') DEFAULT '不加焦点' after article_title;
-- select numbers_articleid count(*) from ali_numbers a
-- join ali_article b on a.numbers_articleid=b.numbers_id
-- groud by num;
select numbers_articleid,count(*) as num from ali_numbers a
left join ali_article b on a.numbers_articleid=b.article_id
;
select article_id,aritcle_click,article_desc,aritcle_good,article_cateid,article_title,aritcle_addtime,article_author,b.num from ali_article a
left JOIN 
(select numbers_articleid,count(*) as num from ali_numbers group by numbers_articleid) b
on b.numbers_articleid=a.article_id;