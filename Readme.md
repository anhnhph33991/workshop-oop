# Xưởng PHP OOP
## Mentor: ``` Thầy Đức Lucifer ```


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

#### Change rules:
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


### Raw Sql Order Details:
```
SELECT 
	p.id as p_id,
    p.name as p_name, 
    p.slug as p_slug, 
    p.image as p_image, 
    p.price as p_price, 
    p.price_offer as p_price_offer, 
    od.id as od_id, 
    od.qty as od_qty,
    o.id as o_id,
    o.user_id as o_user_id,
    o.user_name as o_user_name,
    o.user_email as o_user_email
FROM 
    order_details as od 
INNER JOIN 
    products as p 
ON 
    od.product_id = p.id 
INNER JOIN 
   	orders as o
ON
	od.order_id = o.id
WHERE 
	od.order_id IN (25, 26) 
```
