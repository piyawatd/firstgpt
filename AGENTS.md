# AGENTS.md — Laravel 12 CMS (Blade + Bootstrap)

## 0) Purpose & Scope
- เป้าหมาย: ระบบ CMS ภายในสำหรับบทความ/เพจ/สื่อ (Posts + Pages + Media) พร้อม RBAC ระดับง่าย (admin, editor, viewer)
- ขอบเขตของเอเจนต์: แก้โค้ด PHP/Blade/JS, เพิ่มฟีเจอร์ CRUD, เขียน/ปรับ Request Validation, Policy, Test, และ Docs ภายใน repo นี้เท่านั้น
- หลีกเลี่ยง: เปลี่ยนสัญญา API ที่ client ภายนอกใช้งาน, แก้ infra/prod config, จัดการ secrets จริง

## 1) Tech Stack & Versions
- PHP: 8.2+
- Laravel: 12.x (no legacy structure; ไม่มี `app/Exceptions/Handler.php`/`app/Http/Kernel.php` แบบรุ่นเก่า)
- View: Blade + Bootstrap 5 (ผ่าน CDN)
- DB: MySQL 8 / MariaDB 10.6+ (ผ่าน Eloquent)
- Auth: Breeze (Blade) หรือ Auth scaffolding เทียบเท่า
- Test: Pest/Vitest-phpunit (เลือกอย่างใดอย่างหนึ่งตามโค้ดใน repo)
- Tools: Pint (code style), PHPStan (level 6+), Laravel IDE Helper (ถ้ามี)

## 2) Codebase Map (high-level)
app/
  Http/
    Controllers/
      Admin/
        DashboardController.php
        PostController.php
        PageController.php
        CategoryController.php
        TagController.php
    Middleware/
    Requests/
  Models/
    Post.php
    Page.php
    Catgory.php
    Tag.php
  Policies/
    PostPolicy.php
    PagePolicy.php
bootstrap/
config/
database/
  factories/
  migrations/
  seeders/
public/
resources/
  views/
    layouts/
      app.blade.php
    admin/
      dashboard.blade.php
      posts/
      pages/
      categories/
      tags/
routes/
  web.php
tests/

## 3) Run / Build / Test Recipes
- ติดตั้ง:
  composer install
  cp .env.example .env
  php artisan key:generate
  php artisan migrate --seed
  php artisan storage:link
- รัน dev:
  php artisan serve
- Style/Static analysis:
  ./vendor/bin/pint
  ./vendor/bin/phpstan analyse
- Test:
  php artisan test
  # หรือ
  ./vendor/bin/pest

## 4) Conventions & Quality Gates
- Code style: ใช้ Pint
- Static analysis: PHPStan level 6+ ต้องผ่าน
- Controllers: บางฟังก์ชันสั้น ชี้ไปยัง Service/Action class เมื่อ logic ซับซ้อน
- Validation: ใช้ FormRequest
- Authorization: ใช้ Policy
- Routes: RESTful resource + route model binding
- Views: แยก partials และใช้ components
- JS/CSS: ใช้ Bootstrap/Vanilla
- DB: ใช้ migration/seed
- Commits: Conventional Commits

## 5) Roles & Access
- admin: full
- editor: CRUD จำกัด
- viewer: read-only

## 6) Allowed / Ask-First / Forbidden
- Allowed: เพิ่ม/แก้ Controller, Request, Policy, Blade, Migration, Seeder, Factory
- Ask first: เปลี่ยน Laravel/PHP version, เพิ่มแพ็กเกจใหญ่
- Forbidden: แก้ secrets จริง, ลบ tests โดยไม่มีเหตุผล

## 7) Data Model
- posts: id<uuid>, user_id, title, slug, body, status, cover, published_at, deleted_at, timestamps
- pages: id<uuid>, title, slug, body, is_public, deleted_at, timestamps
- categories: id<uuid>, name, sortorder, timestamps
- tags: id<uuid>, name, timestamps

## 8) UI/UX Rules
- Layout: app.blade.php
- ตาราง index: search, sort, paginate
- ฟอร์ม: _form.blade.php
- อัปโหลด: storage/app/public

## 9) Security & Privacy
- ห้าม log PII
- Validate & Authorize ทุก action
- Escape output

## 10) Playbooks
- เพิ่ม Resource CRUD ใหม่
- เพิ่มฟิลด์ลงใน Post/Page
- เปิดใช้ Slug binding
- เขียน/ปรับ Policy

## 11) Testing Requirements
- Feature tests ครบทุก endpoint admin
- Coverage ≥ 80%
- ใช้ SQLite memory หรือ DB test

## 12) CI
- install → pint → phpstan → test

## 13) Environment
- APP_ENV, APP_DEBUG, DB_CONNECTION, FILESYSTEM_DISK
- ห้ามใส่ secrets จริงลง repo

## 14) Documentation Notes
- อัปเดต README.md เมื่อเพิ่มฟีเจอร์
- ใส่ How to test ใน PR

## 15) Local Overrides
- ใส่เฉพาะข้อมูลของโมดูลนั้น

## 16) Out of Scope
- ไม่เปลี่ยน namespace root
- ไม่เพิ่ม JS framework ใหม่
