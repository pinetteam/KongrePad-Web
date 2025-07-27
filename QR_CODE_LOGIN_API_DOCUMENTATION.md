# KongrePad QR Kod ile Giriş API Dokümantasyonu

## Genel Bakış

KongrePad sistemi, katılımcıların QR kod kullanarak hızlı ve güvenli bir şekilde giriş yapmalarını sağlar. Her katılımcıya benzersiz bir `username` atanır ve bu username QR kod olarak üretilir.

## API Endpoint

### Giriş (Login)

**URL:** `/api/v1/auth/login/participant`  
**Method:** `POST`  
**Content-Type:** `application/json`  
**Authentication:** Gerekli değil

#### Request Body

```json
{
    "username": "string"
}
```

**Parametreler:**
- `username` (zorunlu, string): Katılımcının benzersiz kullanıcı adı. QR koddan okunan değer bu alana gönderilmelidir.

#### Başarılı Response (200 OK)

```json
{
    "token": "1|LaravelSanctumGeneratedTokenString"
}
```

**Response Açıklaması:**
- `token`: Sanctum tarafından üretilen API erişim token'ı. Bu token, sonraki tüm API isteklerinde kullanılmalıdır.

#### Hatalı Response (401 Unauthorized)

```json
{
    "message": "The provided credentials are incorrect."
}
```

**Hata Durumları:**
- Username bulunamadı
- Katılımcı kaydı mevcut değil

#### Validation Hataları (422 Unprocessable Entity)

```json
{
    "message": "The username field is required.",
    "errors": {
        "username": [
            "The username field is required."
        ]
    }
}
```

## Giriş Sonrası İşlemler

Başarılı giriş sonrasında sistem otomatik olarak şu işlemleri gerçekleştirir:

1. **GDPR Onayı:** `gdpr_consent` alanı `true` olarak güncellenir
2. **Kayıt Durumu:** `enrolled` alanı `true` olarak güncellenir
3. **Aktivite Logu:** Giriş işlemi loglanır (action: "login")
4. **Günlük Erişim:** İlk giriş ise günlük erişim kaydı oluşturulur
5. **Kredi Düşümü:** Meeting tipine göre müşteri kredisinden düşüm yapılır:
   - Standard meeting: 10 kredi
   - Premium meeting: 12 kredi

## Token Kullanımı

Giriş sonrası alınan token, diğer tüm API isteklerinde Authorization header'ında kullanılmalıdır:

```
Authorization: Bearer {token}
```

## Authenticated Endpoint'ler

Token ile erişilebilen endpoint'ler:

### Katılımcı Bilgileri
**GET** `/api/v1/participant`

#### Response:
```json
{
    "data": {
        "id": 1,
        "meeting_id": 1,
        "username": "KP2024001",
        "title": "Dr.",
        "first_name": "John",
        "last_name": "Doe",
        "full_name": "Dr. John Doe",
        "identification_number": "12345678901",
        "organisation": "Acme Corp",
        "email": "john.doe@example.com",
        "phone_country_id": 1,
        "phone": "5551234567",
        "password": "hashed_password",
        "type": "attendee",
        "status": 1
    },
    "status": true,
    "errors": null
}
```

### Diğer Erişilebilir Endpoint'ler

- **GET** `/api/v1/meeting` - Meeting bilgileri
- **GET** `/api/v1/hall` - Salon listesi
- **GET** `/api/v1/hall/{id}` - Salon detayı
- **GET** `/api/v1/hall/{id}/active-content` - Aktif içerik
- **GET** `/api/v1/hall/{hall}/program` - Program listesi
- **GET** `/api/v1/program/{program}/session` - Oturum listesi
- **GET** `/api/v1/survey` - Anket listesi
- **GET** `/api/v1/score-game` - Puan oyunu listesi
- **POST** `/api/v1/score-game/{id}/point` - QR kod puan kazanma
- **GET** `/api/v1/virtual-stand` - Sanal stand listesi
- **GET** `/api/v1/announcement` - Duyuru listesi
- **GET** `/api/v1/document` - Doküman listesi

## QR Kod Yapısı

QR kod içeriği sadece katılımcının `username` değerini içerir. Örnek:
- QR Kod İçeriği: `KP2024001`
- QR Kod Boyutu: 256x256 piksel
- Format: PNG

## Güvenlik Notları

1. **Username Benzersizliği:** Her username sistem genelinde benzersizdir (unique constraint)
2. **Token Güvenliği:** Token'lar Laravel Sanctum tarafından yönetilir
3. **Token Süresi:** Token'ların süresi yoktur (expiration: null)
4. **HTTPS Zorunluluğu:** Production ortamında tüm API istekleri HTTPS üzerinden yapılmalıdır

## Hata Kodları Özeti

| HTTP Kodu | Durum | Açıklama |
|-----------|-------|----------|
| 200 | Başarılı | Giriş başarılı, token döndürüldü |
| 401 | Unauthorized | Geçersiz kullanıcı adı |
| 422 | Validation Error | Eksik veya hatalı parametre |
| 500 | Server Error | Sunucu hatası |

## Örnek Kullanım

### cURL ile Giriş:

```bash
curl -X POST https://api.kongrepad.com/api/v1/auth/login/participant \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"username":"KP2024001"}'
```

### Axios (JavaScript) ile Giriş:

```javascript
const response = await axios.post('https://api.kongrepad.com/api/v1/auth/login/participant', {
    username: 'KP2024001'
}, {
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

const token = response.data.token;
```

### Token ile İstek:

```bash
curl -X GET https://api.kongrepad.com/api/v1/participant \
  -H "Authorization: Bearer {token}" \
  -H "Accept: application/json"
```

## Notlar

- QR kod okuma işlemi client tarafında yapılmalıdır
- QR koddan okunan değer direkt olarak `username` parametresine gönderilmelidir
- Participant tipi 3 farklı olabilir: `agent`, `attendee`, `team`
- Status değeri 1 (aktif) olan kullanıcılar giriş yapabilir
- Her giriş işlemi loglanır ve raporlanabilir

---

**Versiyon:** 1.0  
**Son Güncelleme:** 2024  
**API Base URL:** https://api.kongrepad.com/api/v1 