# Data model

Dictionary data is normalized into a lexical entry, word forms, and senses. One lexical entry can therefore contain multiple spellings and multiple meanings without overwriting dialect, register, pronunciation, or translation context.

```text
Language → LexicalEntry → WordForm
                       ├→ Sense (1..n)
                       └→ ExampleSentence
```

Phrases and example sentences are separate entities and retain their own dialect, context, translation, and publication status.
