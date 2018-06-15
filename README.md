# ip-finder
1. I used yii2 downloaded by composer
2. I created a persintent mysql db on my computer
    a. First download mysql and log on
    b. Copy and paste the following:
Create Database ipfinder_db;
Use ipfinder_db;
Create Table locations (id INT NOT NULL AUTO_INCREMENT, loc VARCHAR(128), Primary KEY (id));
INSERT INTO locations VALUES (0,'222.221.244.138:Zimbabwe');
INSERT INTO locations VALUES (0,'116.236.227.50:New York');
INSERT INTO locations VALUES (0,'123.125.66.*:North Carolina');
INSERT INTO locations VALUES (0,'58.248.98.185:Uk, unknown');
INSERT INTO locations VALUES (0,'92.83.167.207:France');
INSERT INTO locations VALUES (0,'124.*.*.*:Baden-Württemberg');
CREATE TABLE logs ( id INT NOT NULL AUTO_INCREMENT, log VARCHAR(10000), PRIMARY KEY (id));
INSERT INTO logs VALUES (0,'222.221.244.138 - - [27/Mar/2010:14:20:04 -0400] "GET /CXg?FBXWY HTTP/1.1" 301 - "http://user.qzone.qq.com/420785012" "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; icafe8; .NET CLR 2.0.50727)"');
INSERT INTO logs VALUES (0,'116.236.227.50 - - [27/Mar/2010:14:20:26 -0400] "GET /Cc5?K71r0Q0N8 HTTP/1.1" 200 - "http://b.qzone.qq.com/cgi-bin/blognew/blog_output_data?uin=954919883&blogid=1268137245&styledm=ctc.qzonestyle.gtimg.cn&imgdm=ctc.qzs.qq.com&bdm=b.qzone.qq.com&mode=2&numperpage=15&blogseed=0.07604838346767906&property=GoRE&timestamp=1269713707" "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)"');
INSERT INTO logs VALUES (0,'123.125.66.27 - - [27/Mar/2010:14:21:20 -0400] "GET /CZE?1P8M7J60P HTTP/1.1" 301 - "-" "Baiduspider+(+http://www.baidu.com/search/spider.htm)"');
INSERT INTO logs VALUES (0,'123.125.66.21 - - [27/Mar/2010:14:21:24 -0400] "GET /CYU?xN0O0N HTTP/1.1" 301 - "-" "Baiduspider+(+http://www.baidu.com/search/spider.htm)"');
INSERT INTO logs VALUES (0,'58.248.98.185 - - [27/Mar/2010:14:22:36 -0400] "GET /CXz?qqren009922ff HTTP/1.1" 301 - "http://xiaoyou.qq.com/index.php?mod=blog&act=showreadzone&u=c265e4bd629300c5081583337f87919ecce5b15ffd929132&blogid=1263713056&type=class&index=43&class_id=104600652" "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)"');
INSERT INTO logs VALUES (0,'92.83.167.207 - - [27/Mar/2010:14:23:18 -0400] "GET /wp-content/uploads/2006/06/nacho_libre.jpg HTTP/1.1" 404 321 "http://www.topicgratuit.com/321777792-filme-bune-de-vazut-si-revazut" "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2"');
INSERT INTO logs VALUES (0,'114.216.191.154 - - [27/Mar/2010:14:23:46 -0400] "POST /CX4?T088TpRT HTTP/1.1" 404 - "http://b.qzone.qq.com/cgi-bin/blognew/blog_output_data?uin=529182847&blogid=1268134870&styledm=ctc.qzonestyle.gtimg.cn&imgdm=ctc.qzs.qq.com&bdm=b.qzone.qq.com&mode=0&numperpage=15&blogseed=0.6960546040189739&property=GoRE&timestamp=1269713930" "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)"');
INSERT INTO logs VALUES (0,'124.192.180.26 - - [27/Mar/2010:14:24:36 -0400] "GET /CYU?L7J61r0O8 HTTP/1.1" 200 - "http://b.cnc.qzone.qq.com/cgi-bin/blognew/blog_output_data?uin=281591118&blogid=1267503975&styledm=qzonestyle.gtimg.cn&imgdm=qzs.qq.com&bdm=b.cnc.qzone.qq.com&mode=2&numperpage=15&blogseed=0.36444995742228037&property=GoRE&timestamp=1269713888" "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)"');
INSERT INTO logs VALUES (0,'123.125.66.54 - - [27/Mar/2010:14:24:58 -0400] "GET /CYT?468071W4 HTTP/1.1" 301 - "-" "Baiduspider+(+http://www.baidu.com/search/spider.htm)"');
INSERT INTO logs VALUES (0,'124.115.0.169 - - [27/Mar/2010:14:25:51 -0400] "GET /Cap?FL570GN6 HTTP/1.1" 301 - "-" "Sosospider+(+http://help.soso.com/webspider.htm)"');

4. I used Yii serve to develop the server one.
5. The site index is the home page and will confirm that you performed all the step correctly.
