# Release checklist

Before tagging a release:
- Bump the plugin version in `crow-nation-qr-generator.php` and `readme.txt`.
- Update `CHANGELOG.md` and `README.md` as needed.
- Verify the plugin activates and runs without PHP warnings.

Release steps
1. Create a signed git tag `vX.Y.Z` and push tags.
2. Create a GitHub release and paste the changelog entry.
3. Verify download artifact and installation on a staging WordPress site.
