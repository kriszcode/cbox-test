# cbox-lsp plugin — teszt-összefoglaló

Dátum: 2026-11-08 · Branch: `proba`

A cbox `cbox-lsp` pluginjának PHP-, Python- és Go-nyelvi szervereit teszteltem a
Claude Code `LSP` eszközén keresztül. Mindhárom nyelven ugyanaz a kis minta-program
készült: egy `Shape` interfész / absztrakt osztály, két implementáció (`Circle`,
`Rectangle`), valamint egy `totalArea` és egy `report` függvény egy külön fájlban,
így a fájlok közti navigáció is tesztelhető.

## Tesztfájlok

| Nyelv  | Szerver      | Fájlok |
|--------|--------------|--------|
| PHP    | intelephense | `main.php`, `src/Shape.php` |
| Python | basedpyright | `python/main.py`, `python/shapes.py` |
| Go     | gopls        | `go/main.go`, `go/shapes/shapes.go`, `go/go.mod` |

## Eredmények

| Művelet | PHP | Python | Go |
|---|:-:|:-:|:-:|
| `documentSymbol` | ✅ | ✅ | ✅ |
| `goToDefinition` (fájlok között) | ✅ | ✅ | ✅ |
| `hover` (szignatúra + docblock) | ✅ | ✅ | ✅ |
| `findReferences` | ✅ | ✅ | ✅ |
| `workspaceSymbol` | ✅ | ✅ | ✅ ¹ |
| `goToImplementation` | ❌ üres válasz | ✅ ² | ✅ |
| `incomingCalls` / `outgoingCalls` | ❌ `Unhandled method` | ✅ | ✅ |
| Diagnosztika szerkesztés után | ✅ | ✅ | ✅ |

¹ A gopls fuzzy keresést végez, és a standard library-ből is ad zajos találatokat.

² Az első futásnál a pyright még `Unhandled method` hibát adott. A szerver
basedpyrightra cserélése után (2026-11-09) újrateszteltem, és most mindhárom
`area` implementációt megtalálja.

### Diagnosztika

Szándékosan elrontott sorokkal teszteltem, ezeket utána eltávolítottam.

- **PHP:** szintaxishiba (`P1001 Unexpected 'EndOfFile'`), nem definiált típus
  (`P1009 Undefined type 'Triangle'`).
- **Python:** rossz argumentumtípus (`reportArgumentType`), rossz típusú értékadás
  (`reportAssignmentType`).
- **Go:** típushiba (`IncompatibleAssign`), nem használt változó (`UnusedVar`).

A diagnosztika aszinkron: néha csak a következő LSP-hívással vagy szerkesztéssel
érkezik meg.

## Megállapítások

- **A PHP-nál hiányzó két funkció valószínűleg nem a plugin hibája.** Úgy tudjuk,
  az intelephense ingyenes változata nem támogatja az implementációk keresését és
  a hívási hierarchiát. Licenckulccsal (`intelephense.licenceKey`) bekapcsolhatók.
- **A Python és a Go teljes támogatást ad:** mind a 9 művelet működik. A Python
  ehhez a basedpyright kell, a sima pyright nem kezeli az implementációk keresését.
- **Futtatás:** a konténerben nincs `php` és `python3` értelmező, ezért ezeket a
  programokat nem lehetett lefuttatni. A Go program lefut (`cd go && go run .`):

  ```
  kör            7.07
  téglalap       6.00
  összesen      13.07
  ```

## Javaslat

A cbox CLAUDE.md LSP-szakaszában érdemes jelezni, hogy PHP-nál (licenc nélkül)
az implementációk keresése és a hívási hierarchia nem érhető el. Ilyenkor ezekre
a grep a tartalék megoldás. (A beépített CLAUDE.md ezt 2026-11-09 óta már
tartalmazza.)
