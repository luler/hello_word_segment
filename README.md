# 分词工具

## 特点

- 分词引擎jieba，参考：https://packagist.org/packages/fukuball/jieba-php
- 内存占用率低
- 使用easyswoole框架搭建，超高性能
- 使用docker、docker-compose搭建，搭建简单

# 搭建

```
docker-compose up -d
```

# 接口

`POST` /api/jiebaCut

##### 描述

- jieba分词-精准模式或者全模式



##### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|sentence |是 | string | 内容 |
|cut_all |否 | bool | 是否全模式只能设置bool类型，默认false |
|options | 否 | array | 参数选项，默认：["HMM" => true]    |

##### 返回示例

```json
{
  "message": "处理成功",
  "code": 200,
  "info": [
    "苹果",
    "手机"
  ]
}
```

`POST` /api/jiebaCutForSearch

##### 描述

- jieba分词-搜索引擎模式

##### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|sentence |是 | string | 内容 |
|options | 否 | array | 参数选项，默认：["HMM" => true]    |

##### 返回示例

```json
{
  "message": "处理成功",
  "code": 200,
  "info": [
    "苹果",
    "手机"
  ]
}
```