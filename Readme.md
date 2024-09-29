# Xưởng PHP OOP

#### Thư Viện:

```
    "bramus/router": "composer require bramus/router ~1.6"
    "eftec/bladeone": "composer require eftec/bladeone"
    "doctrine/dbal": "composer require doctrine/dbal"
    "rakit/validation": "composer require "rakit/validation" "
    "vlucas/phpdotenv": "composer require vlucas/phpdotenv"
```

#### Function helpers:

```
assets()           => 'Đường dẫn assets'
routeClient()      => 'Đường dẫn client'
routeAdmin()       => 'Đường dẫn admin'
upload_file()      => 'upload image `path thư mục`'
upload_multifile() => 'upload multipile file image'
isInvalid()        => 'metho toggle class `is-invalid`'
setToastr()        => 'set toastr'
unsetSessions()    => 'auto unset sessions'
getDateTime()      => 'function get date time format HCM'
middleware_auth()  => 'check private route admin => change middleware_private_route'
middleware_login() => 'check auth login'
middleware_user_auth() => 'check isset login => chan duong link vao auth'
active_account()   => 'url check isset user ? 'login : 'account'
prevPage()         => 'Handle perv page'
nextPage()         => 'handle next page'
handleSalePrice()  => 'cal price sale - auto -20%'
formatPrice()      => 'format price `100000` => `100.000`'
isValidateMultipleImage() => 'validate multi image'
formatStrlen()     => 'formar cat chuoi neu chuoi dai hon thi cat thanh `...`'
createSlug()       => 'create slug format `-` Vd: Quần áo => 'quan-ao'


```

#### Create Rules:

```
Digits() => 'Bắt đầu bằng các đầu số 03,05,07,08,09. Theo sau là : 2,6,8,9. VD: 0367253666'
UniqueEmailRule() => 'Rule check trùng email($id) , update sẽ dựa theo id của email đó ra còn các email khác trùng sẽ báo'
ImageFormatRule() => 'Rule check định dạng ảnh - 4 kiểu success: jpg, png, jpeg, webp'
ImageFileRule() => 'Rule check upload ảnh, check nhiều ảnh'

```

### Status Order:

```
0 => Cho Xac Nhan
1 => Da Xac Nhan
2 => Dang Chuan Bi Hang
3 => Dang Giao Hang
4 => Da Giao Hang
5 => Da Huy
6 => Hoan Hang
```
