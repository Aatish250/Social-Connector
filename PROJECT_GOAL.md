# Project Overview: Simple Social Connector

## 1. Core Objective

Create a lightweight social platform that lets users connect through direct messaging and by joining community groups. The app will focus on demonstrating two main algorithms: **Breadth-First Search (BFS)** for mutual friend discovery and **Jaccard Collaborative Filtering** for making community recommendations.

## 2. Minimal Tech Stack (Actual)

- **Backend:** PHP (procedural and OOP with custom classes)
- **Database:** MySQL (used via PHP's MySQLi or PDO)
- **Frontend:** HTML with PHP templates and Tailwind CSS for styling; JavaScript for basic interactivity

## 3. Database Schema (MVP)

### Users

- `id` (PK)
- `fullname`, `email`, `password`
- `profile_pic`, `location`, `contact`, `dob`, `gender`

### Communities

- `id` (PK)
- `name`, `description`, `category`, `location`
- `creator_id` (FK)

### Connections (The Graph)

- `friendships`: `user_id_1`, `user_id_2` (For BFS)
- `community_members`: `user_id`, `community_id` (For Jaccard)

### Messaging

- `direct_messages`: `sender_id`, `receiver_id`, `content`, `timestamp`
- `group_messages`: `community_id`, `sender_id`, `content`, `timestamp`

## 4. Algorithmic Requirements

- **BFS (Mutual Friends):** Use the `friendships` table to find users who are two hops away (friend of a friend), excluding already connected users.
- **Jaccard Collaborative Filtering (Communities):**
  - For two users: Similarity = (Communities both are in) / (All unique communities either is in)
  - Suggest communities that are popular among users most similar to the target user.

## 5. Scope Constraints

- Simple authentication (JWT or basic session)
- Minimalist user interface, prioritizing core features over looks
- Avoid real-time features unless critical—chat can refresh with polling or manual reload for MVP
- User and community search pages: simple search bars and results lists only
