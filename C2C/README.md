### C2C Alıcı-Satıcı

<img src="/C2C/img/c2c.gif">  

**Proje_için_Kullanılanlar**   
PHP, PDO, MySQL, OOP, MVC(Basic), Javascript, jQuery, Ajax(Json), Bootstrap, CKEditor, DataTable, SweetAlert, Captcha, PHPMailer

**Kayıt**  
E-posta ve şifre ile kayıt yapılıyor.  
Kayıt geçerlilik kuralları bir e-posta sadece bir kişi kullanmabilir, şifre 6 taneden az olmamalıdır.  
Kayıt işlemini ajax(json), oop ve mvc temel mantığı ile yapılması.  
Kayıt işleminde gelen verilerin guvenlik class ile control edilmesi ve şifrenin Password_Hash ile kayıt edilmesi.  
Uyarıların sweetAlert ile gösterilmesi.  


**Login**  
E-posta, şifrenin(Password_Verify) ve captcha kontrolü ve Ajax Json ile girişin yapılması.  
Yanlış girilme durumunda sweetAlert ile uyarı gösterilmesi.  

**Header**  
Satılan toplam ürün fiyatının gösterilmesi.  
Yeni gelmiş ve okunmamış mesajların  sayısının göstergesi ve küçük gösterilmesi.  
Siparişlerin göstergesi ve küçük gösterilmesi.  

**Menü**  
Admin tarafından yönetilen dinamik menu.  

**AnaSayfa**  
Site içi arama yapılacak search alanı.   
En çok satan carousel ile görüntülenmesi.  
Admin tarafından kontrol edilen öne çıkarıtıların listelenmesi.  
Gösterilen ürünlerin resmi, daha önceki puanlama,  yorum sayılarının ve satıcısının gösterilmesi.

**Footer**  
Alanında site ileşim bilgilerinin çekilmesi.

**GelenMesajlar**  
Gelen mesajlar için  header alanındaki mesaj iconundan veya üye işlerimlerin gelen mesajlara ulaşılabilir.  
Gelen mesajların DataTable ve Ajax ile listelenmesi.  
DataTable ile mesaj arama, mesajların sıralandırılması ve sayfalandırılması.  
Gelen mesajların detayının Bootstrap modal, Ajax ve CKEditor ile gösterilmesi.  
Silme işleminde sweetAlert ile gelen uyarı onayından sonra Ajax ile silinmesi.  
Mesaj gönderilenin üzerine tıklayınca ilgili alıcının sayfasına yönlendirilmesi.  
Mesajı okuduğunda durum iconu turuncu olarak gösterilmesi.  
Detaya tıklandığı anda Ajax ile mesaj gösterge alanında sayıyın ve iconun değişmesi.  

**GidenMesajlar**  
Giden mesajların DataTable ve Ajax ile listelenmesi.  
DataTable ile mesaj arama, mesajların sıralandırılması ve sayfalandırılması.  
Giden mesajların detayının Bootstrap modal, Ajax ve CKEditor ile gösterilmesi.  
Silme işleminde sweetAlert ile gelen uyarı onayından sonra Ajax ile silinmesi.  
Mesaj gönderilenin üzerine tıklayınca ilgili satıcının sayfasına yönlendirilmesi.  
Karşı taraf mesajı okuduğunda durum iconu yeşil olarak gösterilmesi.  
Yeni Mesajı bootstrap modal, Ajax ve CKEditor ile gönderilip işlem mesajının sweetalert ile gösterilmesi.  

**Kategoriler**  
Site içi arama yapılacak search alanı.  
Bütün kategorilerin görüntülenmesi.  
Listelenen kategorilerin sayfalandırılması.  
Seçilen kategorideki ürünlerin listelenmesi ve sayfalanması.  
Listelenen ürünlerin resmin,puanlamaların, yorumların, kaç tane satıldığının  ve satıcısının gösterilmesi.  

**ÜrünSayfası**  
Ürün satin al butonu ve eğer ürün satıcıya aitse pasif özelliğinin gösterilmesi.  
Ürün resim, detay, yorum ve puanlamaların gösterilmesi.  
Ürün satış adetinin ve satıcıya ait sayfaya yönlendirme ve satıcı rozetlerinin gösterilmesi.  

**Ödeme Sayfası**  
Ürünün küçük resmi fiyatı satıcısı tutarı ve miktar gösterilmesi.  
Siparişi tamamlaya tıklanınca siparişlerim alanına yönlendirme.  

**Üyeİşlemleri**  
Hesap bilgileri, adres bilgileri, profil resim, şifre güncelleme alanları.  
Satın alınmış ürünlerin gösterilmesi.  
Gelen ve giden mesajların gösterilmesi.  
Eğer alıcı satıcıysa mağaza işlemlerinin görüntülenmesi.  
Satıcınn ürünlerinin görüntülenmesi güncellenmesi.  
Satıcının yeni ürün eklemesi.  
Satıcıya ait ürünlerde ödemesi tamamlanmış ürünlerin listelenmesi.  
Eğer satıcı değilse mağaza başvurunun yapılması ve admin onayına gönderilmesi.  

**Siparişlerim**  
Siparişlerin ürün adı fiyatı ve durumu ile listelenmesi.  
Detay butonu ile siparişe ait bütün detayların görüntülenmesi.  
Ödeme için onay ver butonu.  
Ödeme yapıldıktan sonra sonra satıcı ürünü teslim için teslim edilmesi bekleniyor butonu.  
Ürün teslim alındıktan sonra onaylandı butonu.  
Ürün tesliminden sonra puan ve yorum yapmak için puan/yorum butonu.  
Yapılmış yeni yorum admin onayına gitmektekdir.  
Eğer puan/yorum yapıldıysa ve onaylandıysa detay kısmından önceki yorumlar görüntülenmesi.  

**ÜrünEkle**  
Yeni ürün resim, ürün kategori, ürün adı, ürün fiyatı ve CKEditor ile ürün detay açıklanmasının eklenmesi.  
Yeni eklenmiş ürün önce admin onayına gitmektedir.  
 
**Ürünlerim**  
Ürünlerin listelenmesi yeni eklemiş ürünün admin tarafından onaylandıktan sonra kategorilerde gösterilmesi.  
Ürünün silinmesi sweetAlert uyarı onaylandıktan sonra silinmektedir.  

**GelenSiparişler**  
Gelen siparişlerin listelenmesi.  
Alıcı ödeme yapması için alıcıdan onay bekliyor butonu.  
Ödeme aldıktan sonra ürünü teslim etmek için Teslim Et Butonu .  
Tamamlanmış olan satış işlemi için  tamamlanan siparişler butonu.  
Tamamlanmış olan siparişlerin toplamı header kullanıcı da yazmaktadır.  

**SatıcıSayfası**  
Satıcının en son ne zaman online olduğu gösterilmesi.  
Satıcının satış rakamına göre rozetlerinin gösterilmesi.  
Toplam satılan ürün sayısının gösterilmesi.  
Ürünlerine gelen puanlamaya ortalam puan değerinin yıldız ile gösterilmesi.  
Satıcının bütün ürünlerinin gösterilmesi.  
Satıcıya direkt mesaj gönder butonu.  

**Admin**  
Password_Hash ve Password_Verify kontrollü admin girişi.  
Admin Anasayfa Api ile anlık hava durumu gösterimi. 
Admin Toplam Satış tutarı, Toplam Satış Adeti ve Toplam Ürün Sayısının Dinamik çekilip gösterilmesi.   
Admin Anasayfa GoogleChart ile grafik tablolar ve DB verilerinin google chart ile gösterilmesi.   
Admin Ürünler Crud işlemleri ve çoklu resim ekleme.  
Admin Ürünler ürünlerin aktif/pasif ve C2C tarafı öne çıkar özelliklerinin button ile otomatik yapılması.  
Admin Menülerde Crud işlerimleri C2C tarafı görünüm işlemi.  
Admin Hakkımızda Crud işlemleri Video ekleme ve Ck editörü ile içerik düzenleme. 
Admin Mağaza Başvuları Alıcıların Satıcı olmak için başvurularının onay işlemi.   
Admin Yorumlar C2C tarafından alıcının yapmış oldukları yorumların onay ve silme işlemleri.  
Admin Profil Bilgilerim giriş yapmış olan admin hesap bilgi güncelleme işlemleri.  
Admin Çıkış ile Session sonlarındırma.  