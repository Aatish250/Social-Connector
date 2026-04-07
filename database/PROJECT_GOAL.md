# Project: Social Connector (PHP/MySQL)

## 1. Goal

A minimal social platform where users connect, join communities, and receive suggestions via BFS (mutual friends) and Jaccard Similarity (communities).

## 2. Minimal Tech Stack

- **Backend:** PHP 8.x (Procedural or Basic OOP)
- **Database:** MySQL
- **Frontend:** HTML5, Tailwind CSS (CDN for speed), Vanilla JavaScript
- **Dynamic:** AJAX (using `fetch` or `XMLHttpRequest`) for chat and search results

## 3. Database Schema (The "Source of Truth")

### Table: `users`

- `id` (INT, PK, AI)
- `fullname`, `email`, `password` (VARCHAR)
- `profile_pic`, `location`, `contact`, `dob`, `gender` (VARCHAR/DATE)

### Table: `friendships` (Adjacency List for BFS)

- `id` (INT, PK, AI)
- `user_id_1`, `user_id_2` (INT, FKs)
- `status` (ENUM: 'pending', 'accepted')

### Table: `communities`

- `id` (INT, PK, AI)
- `name`, `description`, `category`, `location` (VARCHAR)
- `creator_id` (INT, FK)

### Table: `community_members` (Input for Jaccard)

- `user_id`, `community_id` (INT, FKs)

### Table: `messages` (Unified Chat)

- `id` (INT, PK, AI)
- `sender_id`, `receiver_id` (INT, FKs - null receiver if community msg)
- `community_id` (INT, FK - null if private msg)
- `content` (TEXT)
- `created_at` (TIMESTAMP)

## 4. Algorithmic Logic (Simple Implementation)

### A. Mutual Friends (BFS)

- Start with `current_user_id`.
- Query all 'accepted' friends into a PHP Array.
- Loop through those friends to find _their_ friends.
- Filter out users who are already friends with `current_user_id`.

### B. Community Suggestions (Jaccard Similarity)

- Function: Compare `Set A` (User 1's Communities) and `Set B` (User 2's Communities).
- Similarity = Count(Intersection) / Count(Union).
- Recommend communities from the user with the highest similarity score.
