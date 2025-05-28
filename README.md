# 🎫 Support Ticketing System API

A simple and modular **RESTful API** for managing support tickets, departments, and internal ticket notes. Built with **OOP PHP** and **PDO**, designed with scalability and maintainability in mind.

---

## 🚀 Features

- 🔐 User authentication system (login, register)
- 🏢 Department management (assign users to departments)
- 📝 Ticket CRUD (create, view, update, delete)
- 🧷 Notes system (internal comments per ticket)
- 📦 Clean MVC architecture using raw PHP and PDO
- ⚙️ RESTful API structure with JSON responses
- 💡 Secure input handling and SQL abstraction layer
- 🧪 Ready for frontend or SPA integration

---

## 📁 Project Structure

```
/app
├── controller/       # API controllers (e.g., UserController, TicketController)
├── core/             # Core classes (Router, Database, Model, etc.)
├── models/           # Business logic models (User, Ticket, Note, Department)
├── interface/        # Interface classes
├── middlewares/      # Middlewares classes
├── init.php          # Load all the required class

/public
└── index.php         # API entry point
```



---

## 📌 API Endpoints (Sample)

### Auth
- `POST /login` – User login
- `POST /register` – Register new user

### Tickets
- `GET /tickets` – List all tickets
- `POST /tickets` – Create a new ticket
- `GET /tickets/{id}` – View single ticket
- `PUT /tickets/{id}` – Update ticket
- `DELETE /tickets/{id}` – Delete ticket
- `PUT /tickets/{id}/assign` – Assign ticket
- `PUT /tickets/{id}/status` – Change ticket status

### Notes
- `POST /notes` – Add internal note
- `POST /notes` – Create a new note
- `GET /notes/{id}` – View single note
- `PUT /notes/{id}` – Update note
- `DELETE /notes/{id}` – Delete note

### Departments
- `GET /departments` – List departments
- `POST /departments` – Create department
- `GET /departments/{id}` – View single department
- `PUT /departments/{id}` – Update department
- `DELETE /departments/{id}` – Delete department

---

## 🧰 Tech Stack

- PHP 8.x
- PDO (MySQL)
- Postman (for API testing)

---

## 🛠️ Installation

```bash
git clone https://github.com/your-username/support-ticket-api.git
cd support-ticket-api