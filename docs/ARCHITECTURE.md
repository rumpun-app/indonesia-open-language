# Architecture

The project is API-first. Laravel owns business rules, authorization, validation, provenance, and publication workflows. PostgreSQL is the production relational store; Redis is used for cache and queues; S3-compatible storage is used for media.

Domain data is never treated as a simple translation map. Language, dialect, region, lexical entries, sources, contributions, reviews, and immutable versions are separate concepts.

AI consumes published or verified data through a retrieval layer. AI output is labeled and must enter the normal community validation workflow before becoming canonical data.
