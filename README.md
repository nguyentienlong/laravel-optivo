# laravel-optivo
Optivo mailer for Laravel ( >= v5 ).

**Usage:**

- `composer require longkyanh/laravel-optivo`

- Dependency injection

```
use Longkyanh\Mailer\Optivo as Mailer;

class TestEmailController extends Controller
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer; // auto resolve by Laravel container
    }

    public function testEmail():Response
    {
        $mailingListName = 'a-test-mailing-list';
        $locale = 'en';
        $recipient = 'nguyentienlong88+1@gmail.com';
        $data = [
            'firstname' => time(),
            'lastname' => time(),
            'age' => time(),
            'message' => time(),            
        ];
        $temp = $this->mailer->send($mailingListName, $locale, $recipient, $data);

        return new Response($temp);
    }
}
```

- Use with `OptivoMailer` Facade

  - Add this line below into  config/app.php

    `Longkyanh\Mailer\OptivoServiceProvider::class,`

  - Then use in any class

    ```
    // before any class definition
    use Longkyanh\Mailer\OptivoMailer;

    // call send function anywhere you want
    OptivoMailer::send($mailingListName, $locale, $recipient, $data);
    ```
