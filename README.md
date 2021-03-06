# 12306-Book-System

## Core Feature

### 需求1:列车
* 每个车次的列车包含下述信息
    * 始发站,中间经停站,终点站
    * 每站的发车时间和到达时间
    * 票价:可能有下述种类的票
        * 硬座、软座
        * 硬卧:上铺、中铺、下铺
        * 软卧:上铺、下铺
* 假设:所有列车每天都准时运行,票价不变


### 需求2:列车座位
* 为了便于测试,假设每次列车、每种座位、每天预留了5个
* 例如:如果该车次只包含硬座和软座,那么
    * 10月20日就有5个硬座位置和5个软座位置
    * 10月21日也有5个硬座位置和5个软座位置
* 一个座位可以售给两个旅行段不重叠的乘客
    * 例如:G101
        * 张三从北京南到济南西
        * 李四从济南西到上海虹桥
        * 那么,可以用同一个座位


### 需求3:乘客
* 每位乘客在使用前需要注册
    * 登记姓名,身份证(18位整数),手机号(10位整数),信用卡(开户行名称,16位整数)
* 系统保存每位乘客的所有历史订单


### 需求4:查询车次
* 一个乘客可以提出多种查询
* 给定车次序号,例如G101,显示该车次所有信息
    * 包括
        * 始发站,中间经停站,终点站
        * 每站的发车时间和到达时间
        * 票价
* 如果指定了具体日期,那么显式该天的余票信息
* 如果没有指定具体日期,那么就显式第二天的余票信息
* 提供链接,可以直接预订


### 需求5:查询两地之间的车次
* 给定出发地和到达地,给定出发日期,给定座位类型(多选,例如:只考虑软座和软卧,只考虑硬座,都可以等)
* 显示
    * 两地之间直达列车
    * 两地之间换一次车的列车组合
    * 两地之间换两次车的列车组合

* 列车组合的要求
    * 换乘地必须是同一城市
    * 换乘时间至多不超过4小时
    * 如果换乘地点是同一车站,那么不换乘时间至少1小时
    * 如果换乘地点是同城的不同车站,那么换乘时间至少2小时

* 可以按照票价、行程时间、起始时间三种标准排序
* 提供链接,可以进行预订


### 需求6:查询往返行程
* 在需求5的基础上,进一步提供往返行程的查询和
    预订

### 需求7:生成订单
* 在查询页,点击预订,显示订单确认页
    * 如果有多种可选的类型的座位,需要用户在订单确认页选择座位类型
    * 每张车票收取5元订票费
        * 如果订单包含两个车次的组合,那么就收取5*2=10元
* 乘客在订单确认页确认了订单后,就生成订单
* 每个订单包含:订单号、所有列车车次、出发和到达站、座位类型、票价、日期和时间


### 需求8:查询订单和删除订单
* 乘客可以查询历史订单
* 第一种方式
    * 给定订单号,显示订单具体内容
    * 在查询具体内容页,可以删除订单
* 第二种方式
    * 给定订单出发日期范围,显示订单列表
    * 订单列表包括:订单号,日期、时间、出发到达站、总费用(包括订单费)
    * 订单号提供链接,可以点击显示订单具体信息

### 需求9:管理员
* 管理员可以查询分析总信息
    * 总订单数
    * 总票价,总订票费
    * 最热点车次排序,排名前10的车次

## ER


![6-0](/resources/er.png)

## Relation Table

![6-0](/resources/er-1.png)












