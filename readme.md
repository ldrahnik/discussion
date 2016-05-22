Install discussion
==========

`git clone https://github.com/ldrahnik/discussion.git`
`composer install`

Create database discussion and create local fongig too:

```
dibi:
    driver: mysql
    port: 5433
    database: discussion
    username: 'root'
    password:
    lazy: TRUE
```

And finally enjoy spamming comments