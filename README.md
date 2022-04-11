# docker-laravel-practice

# テーブル設計

## Usersテーブル

| Culumn                      | Type         | Options                     |
| -------------------------   | ------------ | --------------------------- |
| id                          | int(11)      | null: false, auto_increment |
| nickname                    | varchar(255) | null: false                 |
| email                       | varchar(255) | null: false                 |
| password                    | varchar(255) | null: false                 |
| created_at                  | timestamp    | ON UPDATE CURRENT_TIMESTAMP |

### Association

- has_many :items
- has_many :comments

## Pre_Usersテーブル

| Culumn                      | Type         | Options                     |
| -------------------------   | ------------ | --------------------------- |
| id                          | int(11)      | null: false, auto_increment |
| email                       | varchar(255) | null: false                 |
| created_at                  | timestamp    | ON UPDATE CURRENT_TIMESTAMP |


## Items テーブル

| Column                      | Type         | Options                        |
| --------------------------- | ------------ | ------------------------------ |
| id                          | int(11)      | null: false, auto_increment    |
| item_title                  | varchar(255) | null: false                    |
| item_explain                | text         | null: false                    |
| created_at                  | timestamp    | ON UPDATE CURRENT_TIMESTAMP    |
| user_id                     | int(11)      | null: false, foreign_key: true |

### Association

- belongs_to :user
- has_many :comments

## Comments テーブル

| Column                      | Type         | Options                        |
| --------------------------- | ------------ | ------------------------------ |
| id                          | int(11)      | null: false, auto_increment    |
| text                        | text         | null :false                    |
| created_at                  | timestamp    | ON UPDATE CURRENT_TIMESTAMP    |
| user_id                     | int(11)      | null :false, foreign_key: true |
| item_id                     | int(11)      | null :false, foreign_key: true |

### Association

- belongs_to :user
- belongs_to :item